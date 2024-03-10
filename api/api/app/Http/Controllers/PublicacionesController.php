<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Models\EtiquetaPublicacion;
use App\Models\Publica;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/publicaciones",
     *     summary="Mostrar publicaciones",
     *     tags={"Publicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las publicaciones."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *   security={
     *              {"sanctum": {}},
     *      },
     * )
     */
    public function index()
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $publicaciones_con_etiquetas = Publicacion::select(
            'publicaciones.id as id',
            'publicaciones.titulo',
            'publicaciones.descripcion',
            'publicaciones.imagen',
            'publicaciones.fecha_publicacion',
            'publicaciones.fecha_inicio',
            'publicaciones.fecha_fin',
            'publicaciones.activo',
            'users.nombre as publicado_por',
            'users.direccion as direccion_comercio',
            'users.email',
            'users.telefono',
            'users.avatar',
            'tipo_publicaciones.nombre as tipo',
            DB::raw('GROUP_CONCAT(etiquetas.nombre) as etiquetas')
        )
            ->join('tipo_publicaciones', 'publicaciones.id_tipo', 'tipo_publicaciones.id')
            ->join('publican', 'publican.id_publicacion', 'publicaciones.id')
            ->join('etiquetas_publicaciones', 'publicaciones.id', 'etiquetas_publicaciones.id_publicacion')
            ->join('etiquetas', 'etiquetas_publicaciones.id_etiqueta', 'etiquetas.id')
            ->join('users', 'publican.id_usuario', 'users.id')
            ->groupBy(
                'publicaciones.id',
                'publicaciones.titulo',
                'publicaciones.descripcion',
                'publicaciones.imagen',
                'publicaciones.fecha_publicacion',
                'publicaciones.fecha_inicio',
                'publicaciones.fecha_fin',
                'publicaciones.activo',
                'users.nombre',
                'users.direccion',
                'users.email',
                'users.telefono',
                'users.avatar',
                'tipo_publicaciones.nombre'
            )
            ->get();

        $publicaciones = Publicacion::select(
            'publicaciones.id as id',
            'publicaciones.titulo',
            'publicaciones.descripcion',
            'publicaciones.imagen',
            'publicaciones.fecha_publicacion',
            'publicaciones.fecha_inicio',
            'publicaciones.fecha_fin',
            'publicaciones.activo',
            'users.nombre as publicado_por',
            'users.direccion as direccion_comercio',
            'users.email',
            'users.telefono',
            'users.avatar',
            'tipo_publicaciones.nombre as tipo',
            DB::raw('(SELECT etiquetas.nombre FROM etiquetas_publicaciones INNER JOIN etiquetas ON etiquetas_publicaciones.id_etiqueta = etiquetas.id WHERE etiquetas_publicaciones.id_publicacion = publicaciones.id) as etiquetas')
        )
            ->join('tipo_publicaciones', 'publicaciones.id_tipo', 'tipo_publicaciones.id')
            ->join('publican', 'publican.id_publicacion', 'publicaciones.id')
            ->join('users', 'publican.id_usuario', 'users.id')
            ->groupBy(
                'publicaciones.id',
                'publicaciones.titulo',
                'publicaciones.descripcion',
                'publicaciones.imagen',
                'publicaciones.fecha_publicacion',
                'publicaciones.fecha_inicio',
                'publicaciones.fecha_fin',
                'publicaciones.activo',
                'users.nombre',
                'users.direccion',
                'users.email',
                'users.telefono',
                'users.avatar',
                'tipo_publicaciones.nombre'
            )
            ->whereNotIn('publicaciones.id', EtiquetaPublicacion::select('id_publicacion')->get())
            ->get();

        if ($publicaciones->isEmpty()) {
            return response()->json([
                'message' => "There's no content in records"
            ], 404);
        }
        $resultados = $publicaciones->merge($publicaciones_con_etiquetas);

        return response()->json([
            'publicaciones' => $resultados,
            'publicaciones_sin_etiquetas' => $publicaciones,
            'publicaciones_con_etiquetas' => $publicaciones_con_etiquetas
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/publicaciones",
     *     summary="Crear publicaciones",
     *     tags={"Publicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Crea la publicación."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),  
     *      security={
     *            {"sanctum": {}},
     *      },
     * )
     */
    public function store(Request $request)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $validated = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'fecha_inicio' => 'nullable',
            'fecha_fin' => 'nullable',
            'activo' => 'required',
            'id_publica' => 'required',
            'id_tipo' => 'required',
            'etiquetas' => 'nullable'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }

        $fecha_inicio = null;
        $fecha_fin = null;
        if ($request->fecha_inicio != null) $fecha_inicio = $request->fecha_inicio;
        if ($request->fecha_fin != null) $fecha_fin = $request->fecha_fin;

        $created = Publicacion::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'fecha_publicacion' => date('Y-m-d'),
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'activo' => $request->activo,
            'id_tipo' => $request->id_tipo
        ]);

        if (count($request->etiquetas) > 0) {
            foreach ($request->etiquetas as $etiqueta) {
                EtiquetaPublicacion::create([
                    'id_publicacion' => $created->id,
                    'id_etiqueta' => $etiqueta
                ]);
            }
        }

        if (!$created) {
            return response()->json([
                'status' => 500,
                'errors' => $created->errors()
            ], 500);
        }

        $publica = Publica::create([
            'id_usuario' => $request->id_publica,
            'id_publicacion' => $created->id
        ]);


        if (!$publica) {
            return response()->json([
                'status' => 500,
                'errors' => $created->errors()
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => "Se ha creado el elemento con id " . $created->id
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *     path="/api/publicaciones/:id",
     *     summary="Mostrar una publicacion",
     *     tags={"Publicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar una publicacion."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *    security={
     *              {"sanctum": {}},
     *      },
     * )
     */
    public function show($id)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if (!$id) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no encontrado en la petición'
            ], 404);
        }

        $publicaciones = Publicacion::select(
            'publicaciones.id',
            'publicaciones.titulo',
            'publicaciones.descripcion',
            'publicaciones.imagen',
            'publicaciones.fecha_publicacion',
            'publicaciones.fecha_inicio',
            'publicaciones.fecha_fin',
            'publicaciones.activo',
            'tipo_publicaciones.nombre as tipo'
        )
            ->join('tipo_publicaciones', 'publicaciones.id_tipo', 'tipo_publicaciones.id')
            ->where('publicaciones.id', $id)
            ->get();

        $publican = User::select('users.nombre', 'users.direccion', 'users.email', 'users.avatar')
            ->join('publican', 'publican.id_usuario', 'users.id')
            ->where('publican.id_publicacion', $id)->get();


        $etiquetas = Etiqueta::select('etiquetas.nombre')
            ->join('etiquetas_publicaciones', 'etiquetas.id', 'etiquetas_publicaciones.id_etiqueta')
            ->where('id_publicacion', $id)->get();



        if ($publicaciones == null || $publicaciones->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'publicacion' => $publicaciones,
            'publican' => $publican,
            'etiquetas' =>  $etiquetas
        ], 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\PUT(
     *     path="/api/publicaciones/:id",
     *     summary="Actualizar publicaciones",
     *     tags={"Publicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Se ha actualizado el usuario."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *   security={
     *              {"sanctum": {}},
     *      },
     * )
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if (!$id) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no encontrado en la petición'
            ], 404);
        }

        $exists = Publicacion::find($id);

        if ($exists == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe'
            ], 404);
        }


        $validated = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'fecha_inicio' => 'nullable',
            'fecha_fin' => 'nullable',
            'activo' => 'required',
            'id_tipo' => 'required',
            'etiquetas' => 'nullable'
        ]);


        if ($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }

        $publica = Publica::where("id_publicacion", $id);
        if ($publica == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe en publicados'
            ], 404);
        }

        $fecha_inicio = null;
        $fecha_fin = null;
        if ($request->fecha_inicio != null) $fecha_inicio = $request->fecha_inicio;
        if ($request->fecha_fin != null) $fecha_fin = $request->fecha_fin;

        $updated = $exists->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'fecha_publicacion' => date('Y-m-d'),
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'activo' => $request->activo,
            'id_tipo' => $request->id_tipo
        ]);

        if (!$updated) {
            return response()->json([
                'status' => 500,
                'message' => 'El elemento con id ' . $exists->id . ' no se ha podido actualizar en publicaciones'
            ], 500);
        }

        /* actualización del campo de comercios */


        if ($publica == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe en hijo',
            ], 404);
        }

        /* id usuarios */
        $validated = Validator::make($request->all(), [
            'id_usuario.*' => 'numeric',
        ]);

        if ($validated->fails()) return response()->json([
            'status' => 401,
            'message' => $validated->errors()
        ], 401);

        if (count($request->id_usuario) >= 1) {
            $ya_existentes = Publica::select('id_usuario')->where('id_publicacion', $id);
            foreach ($request->id_usuario as $usuario) {
                $publicado = Publica::where('id_usuario', $usuario)->where('id_publicacion', $id)->first();
                if (!$publicado) Publica::create([
                    'id_publicacion' => $id,
                    'id_usuario' => $usuario
                ]);
                //else $publicado->delete();
            }

            foreach ($ya_existentes as $previo) {
                if (!in_array($previo, $request->id_usuario)) {
                    $borrado = Publica::where('id_usuario', $previo)->where('id_publicacion', $id);
                    $borrado->delete();

                    if (!$borrado) return response()->json([
                        'status' => 500,
                        'message' => 'El elemento con id ' . $previo . ' no se ha podido actualizar en publican'
                    ], 500);
                }
            }
        }

        /* etiquetas */

        $validated = Validator::make($request->all(), [
            'id_etiqueta.*' => 'numeric',
        ]);

        if ($validated->fails()) return response()->json([
            'status' => 401,
            'message' => $validated->errors()
        ], 401);

        if (count($request->id_etiqueta) >= 1) {
            $ya_existentes = EtiquetaPublicacion::select('id_etiqueta')->where('id_publicacion', $id)->get()->pluck('id_etiqueta')->toArray();
            foreach ($request->id_etiqueta as $etiqueta) {
                $publicado = EtiquetaPublicacion::where('id_etiqueta', $etiqueta)->where('id_publicacion', $id)->first();
                if (!$publicado) {
                    EtiquetaPublicacion::create([
                        'id_publicacion' => $id,
                        'id_etiqueta' => $etiqueta
                    ]);
                }
            }
        
            foreach ($ya_existentes as $previo) {
                if (!in_array($previo, $request->id_etiqueta)) {
                    $borrado = EtiquetaPublicacion::where('id_etiqueta', $previo)->where('id_publicacion', $id)->delete();
                    if (!$borrado) {
                        return response()->json([
                            'status' => 500,
                            'message' => 'El elemento con id ' . $previo . ' no se ha podido actualizar en etiquetas publicaciones'
                        ], 500);
                    }
                }
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Se ha actualizado el elemento ' . $exists->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *     path="/api/publicacion",
     *     summary="Borra la publicacion",
     *     tags={"Publicaciones"},
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos los usuarios."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *  security={
     *              {"sanctum": {}},
     *      },
     * )
     */
    public function destroy($id)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);


        /* falta filtrar que cada usuario solo pueda borrar sus publicaciones */
        if (!$id) {
            return response()->json([
                'status' => 404,
                'message' =>  'Id no encontrado en la petición'
            ], 404);
        }


        $exists = Publicacion::find($id);

        /* descomentar para hacer el borrado unicamente que concuerde con el usuario que está logueado */
        /*$exists = Publicacion::join('publican', 'publican.id_publicacion', 'publicaciones.id')
                ->where('publican.id_usuario', Auth()->user()->id)
                ->where('publicaciones.id', $id)
                ->get();*/

        // if($exists == null || $exists->isEmpty()) {
        if ($exists == null) {
            return response()->json([
                'status' => 404,
                'post_encontrado' => $exists,
                'message' => 'Id ' . $id . ' no existe en la tabla o no tienes permisos para borrar dicho post',
                'id_solicitante' => Auth()->user()->id
            ], 404);
        }

        $exists = Publicacion::find($id);
        $exists->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Borrado el elemento id ' . $id,
            'post_borrado' => $exists,
        ], 200);
    }
}
