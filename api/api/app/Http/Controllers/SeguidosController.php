<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Seguido;
use App\Models\User;


class SeguidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *     path="/api/seguidos",
     *     summary="Mostrar seguidos",
     *     tags={"Seguidos"},
     *     @OA\Response(
     *         response=200,
     *         description="Se ha completado la petición."
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

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $seguidos = Seguido::select('seguidos.id','seguidos.id_seguido', 'seguidos.id_seguidor')
            //->join('users', 'seguidos.id_seguidor', 'users.id')
            ->orderBy('seguidos.id_seguido', 'asc')->get();
        
        //$seguidos = ['test'];
        return response()->json([
            'status' => 200,
            'seguidos' => $seguidos
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
     *     path="/api/seguidos",
     *     summary="Crear seguidor",
     *     tags={"Seguidos"},
     *     @OA\Response(
     *         response=200,
     *         description="Se ha completado la petición."
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

    public function store(Request $request)
    {
        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(
            Auth::check()  && Auth()->user()->hasRole('particular') 
        ) {
            $validated = Validator::make($request->all(), [
                'id_seguidor' => 'required',
                'id_seguido' => 'required',
            ]);
    
            if($validated->fails()) {
                return response()->json([
                    'status' => 401,
                    'errors' => $validated->errors()
                ], 401);
            }
            
            $created = Seguido::create([
                'id_seguidor' => $request->id_seguidor,
                'id_seguido' => $request->id_seguido
            ]);
    
            
            if(!$created){
                return response()->json([
                    'status' => 500,
                    'errors' => $created->errors()
                ], 500);
            }
    
            return response()->json([
                'status' => 200,
                // 'message' => "Se ha creado el elemento con id " .$ayuntamiento->id  /* id del ayuntamiento*/
                'message' => "Se ha creado el elemento con id " .$created->id
            ], 200);
        } else {
            return response()->json([
                'status' => 403,
                "message" => "No tienes permisos para realizar la acción"
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
    * @OA\Get(
    *     path="/api/seguidos/:id",
    *     summary="Muestra los seguidores de un usuario dado por ID",
    *     tags={"Seguidos"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha completado la petición."
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
    public function show($id)
    {
        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);


        if(!$id) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no encontrado en la petición'
            ], 404);
        }

        $exists = User::select(
            /* From Users */
            'users.id as id',
            'users.usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar'
        )
            ->join('seguidos', 'seguidos.id_seguidor', 'users.id')
            ->where('seguidos.id_seguido', $id)
            ->get();


        if($exists == null || $exists->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no existe'
            ], 404);
        } 

        return response()->json([
            'status' => 200,
            'seguidos' => $exists
        ], 200);
    }


      /**
    * @OA\Get(
    *     path="/api/obtenerseguidos/:id",
    *     summary="Muestra los seguidos de un usuario dado por id",
    *     tags={"Seguidos"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha completado la petición."
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
    public function obtener_seguidos($id)
    {
        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);


        if(!$id) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no encontrado en la petición'
            ], 404);
        }

        $exists = User::select(
            /* From Users */
            'users.id as id',
            'users.usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar'
        )
            ->join('seguidos', 'seguidos.id_seguido', 'users.id')
            ->where('seguidos.id_seguidor', $id)
            ->get();


        if($exists == null || $exists->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no existe'
            ], 404);
        } 

        return response()->json([
            'status' => 200,
            'seguidos' => $exists
        ], 200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*
    public function update(Request $request, $id)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

                 /**
    * @OA\Post(
    *     path="/api/seguidos/borrar",
    *     summary="Borrar seguido",
    *     tags={"Seguidos"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha completado la petición."
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
    public function borrar_seguidor(Request $request)
    {
        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(Auth::check() && Auth()->user()->hasRole('particular') || Auth::check() && Auth()->user()->hasRole('comercio') || Auth::check() && Auth()->user()->hasRole('ayuntamiento')) {
            $exists = Seguido::where('id_seguidor',  $request->id_seguidor)
                    ->where('id_seguido', $request->id_seguido );

            if($exists == null) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Id '.$id.' no existe la relación que buscas'
                    ], 404);
            } 
        
            $deleted = $exists->delete();

            $validated = Validator::make($request->all(), [
                'id_seguidor' => 'required',
                'id_seguido' => 'required'
            ]);
  
            if($validated->fails()) {
                return response()->json([
                    'status' => 401,
                    'errors' => $validated->errors()
                ], 401);
            }

            if(!$deleted) return response()->json([
                'status' => 500,
                'message' => 'No se ha podido borrar la relación'
            ], 500);
            
            return response()->json([
                'status' => 500,
                'message' => 'Se ha borrado la relación entre seguidor '.$request->id_seguido.' y el seguido '.$request->id_seguidor
            ], 500);
        };

    }
}
