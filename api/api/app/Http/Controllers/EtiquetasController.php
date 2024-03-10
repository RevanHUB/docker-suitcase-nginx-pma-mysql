<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EtiquetasController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/etiquetas",
    *     summary="Mostrar etiquetas",
    *     tags={"Etiquetas"},
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los elementos."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $etiquetas = \App\Models\Etiqueta::select('*')
            ->get();
        if ($etiquetas->isEmpty()) {
            return response()->json([
                'message' => "There's no content in records"
            ], 404);
        }
        return response()->json([
            'etiquetas' => $etiquetas
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
    *     path="/api/etiquetas",
    *     summary="Crear etiqueta",
    *     tags={"Etiquetas"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha creado la etiqueta."
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
    public function store(Request $request)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $validated = Validator::make($request->all(), [
            'nombre' => 'required|unique:etiquetas'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }

        $created = Etiqueta::create([
            'nombre' => $request->nombre
        ]);

        if (!$created) {
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
    *     path="/api/etiquetas/:id",
    *     summary="Muestra la etiqueta por ID",
    *     tags={"Etiquetas"},
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

        $exists = Etiqueta::select('*')
            ->where('id', $id)
            ->get();


        if($exists == null || $exists->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no existe'
            ], 404);
        } 

        return response()->json([
            'status' => 200,
            'etiqueta' => $exists
        ], 200);
    }



    
     /**
    * @OA\Put(
    *     path="/api/etiquetas/:id",
    *     summary="Actualizar etiquetas",
    *     tags={"Etiquetas"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha actualizado el elemento."
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

        $exists = Etiqueta::find($id);
        if ($exists == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe'
            ], 404);
        }

       
    
         $validated = Validator::make($request->all(), [
                'nombre' => 'required|unique:etiquetas'
            ]);
      

        if ($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }

        $exists = Etiqueta::find($id);


        $updated = $exists->update([
            'nombre' => $request->nombre
        ]);

        if (!$updated) {
            return response()->json([
                'status' => 500,
                'message' => 'El elemento con id ' . $exists->id . ' no se ha podido actualizar'
            ], 500);
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
    *     path="/api/etiquetas/:id",
    *     summary="Borra etiquetas",
    *     tags={"Etiquetas"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha borrado el elemento."
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
    public function destroy($id)
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);
        if($id == 1) return response()->json([
            'status' => 403,
            'message' => "No tienes permisos para borrar este usuario"
        ], 403);
        if (!$id) {
            return response()->json([
                'status' => 404,
                'message' =>  'Id no encontrado en la petición'
            ], 404);
        }

        if ($id != 1) {
            $exists = Etiqueta::find($id);
            if ($exists == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id ' . $id . ' no existe'
                ], 404);
            }

            $exists->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Borrado el elemento id ' . $id
            ], 200);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'No permitido'
            ], 403);
        }
    }
}
