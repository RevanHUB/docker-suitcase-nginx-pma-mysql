<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
/* Models */

use App\Models\User;
use App\Models\Comercio;

class ComerciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      /**
    * @OA\Get(
    *     path="/api/comercios/",
    *     summary="Mostrar comercios",
    *     tags={"Comercios"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha actualizado el usuario."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * ),
    *   security={
     *              {"sanctum": {}},
     *      },
    */
    public function index()
    {

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);


        $comercios = User::select(
            /* From Users */
            'users.id as id',
            /* From Comercios */
            'comercios.descripcion as descripcion',
            'categorias.nombre as nombre_categoria',
            'usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio'
        )
            ->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('comercios', 'comercios.id_usuario', 'users.id')
            ->join('categorias', 'categorias.id', 'comercios.id_categoria')
            ->get();

        if($comercios->isEmpty()) {
            return response()->json([
                'message' => "There's no content in records"
            ], 404);
        }

        return response()->json([   
            'comercios'=> $comercios
        ], 200);

  
    }

    
    /**
     * Gets the element by Id 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        /**
    * @OA\Get(
    *     path="/api/comercios/:id",
    *     summary="Mostrar un comercio por ID",
    *     tags={"Comercios"},
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
    public function show($id) {
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
            /* From Ayuntamientos */
            'comercios.descripcion as descripcion',
            'categorias.nombre as categoria',
            'usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio'
        )
            ->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('comercios', 'comercios.id_usuario', 'users.id')
            ->join('categorias', 'comercios.id_categoria', 'categorias.id')
            ->where('users.id', $id)
            ->get();


        if($exists == null || $exists->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'Id '.$id.' no existe'
            ], 404);
        } 

        return response()->json([
            'status' => 200,
            'ayuntamiento' => $exists
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
    *     path="/api/comercios/",
    *     summary="Crear comercio",
    *     tags={"Comercios"},
    *     @OA\Response(
    *         response=200,
    *         description="Se ha creado el elemento."
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

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $validated = Validator::make($request->all(), [
            'usuario' => 'required|unique:users',
            'password' => 'required',
            'nombre' => 'required',
            'email' => 'required|unique:users',
            'direccion' => 'required',
            'id_municipio' => 'required',
            'telefono' => 'required',
            'avatar' => 'nullable',
            'descripcion' => 'required',
            'id_categoria' => 'required|integer'
        ]);

        if($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }

        $created = User::create([
            'usuario' => $request->usuario,
            'password' => bcrypt($request->password),
            'nombre' => $request->nombre,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'id_municipio' => $request->id_municipio,
            'telefono' => $request->telefono,
            'avatar' => $request->avatar
        ]);



        if(!$created){
            return response()->json([
                'status' => 500,
                'errors' => $created->errors()
            ], 500);
        }

        $comercio = Comercio::create([
            'descripcion' => $request->descripcion,
            'id_usuario' => $created->id,
            'id_categoria' => $request->id_categoria
        ]);

        
        if(!$comercio){
            return response()->json([
                'status' => 500,
                'errors' => $comercio->errors()
            ], 500);
        }

        return response()->json([
            'status' => 200,
            //'message' => "Se ha creado el elemento con id " .$comercio->id /* para devolver el id del comercio */
            'message' => "Se ha creado el elemento con id " .$created->id 
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
    * @OA\Put(
    *     path="/api/comercios/:id",
    *     summary="Actualizar comercios",
    *     tags={"Comercios"},
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


    public function update(Request $request, $id)
    {
        /* como el método update de UsersControllers solo devuelve respuesta, 
        * no se puede hacer el concepto de anidar una sobre otra para adelantar, 
        * esto podría hacerse si hubieramos empezado con los métodos que devuelvan true o false
        */


        if(!Auth()->user()->hasRole('admin')) return response()->json([
            'status' => 403,
            "message" => "No tienes permisos para borrar los elementos"
        ], 403);

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(Auth::check()  && Auth()->user()->hasRole('admin') || Auth::check()  && Auth()->user()->hasRole('comercio') || Auth::check()  && Auth()->user()->hasRole('ayuntamiento')) {
            if(!$id) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no encontrado en la petición'
                ], 404);
            }
    
            $exists = User::find($id);
    
            if($exists == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en padre'
                ], 404);
            } 
    
              /* hago comprobación de que se trabaje sobre el mismo usuario */
              if($exists->usuario != $request->usuario && $exists->email != $request->email) {
                $validated = Validator::make($request->all(), [
                    'usuario' => 'required|unique:users',
                    'password' => 'required',
                    'nombre' => 'required',
                    'email' => 'required|unique:users',
                    'direccion' => 'required',
                    'id_municipio' => 'required',
                    'telefono' => 'required',
                    'avatar' => 'nullable',
                    'id_categoria' => 'required',
                    'descripcion' => 'required'
                ]);
            } else {
                $validated = Validator::make($request->all(), [
                    'usuario' => 'required',
                    'password' => 'required',
                    'nombre' => 'required',
                    'email' => 'required',
                    'direccion' => 'required',
                    'id_municipio' => 'required',
                    'telefono' => 'required',
                    'avatar' => 'nullable',
                    'id_categoria' => 'required',
                    'descripcion' => 'required'
                ]);
            }
      
            if($validated->fails()) {
                return response()->json([
                    'status' => 401,
                    'errors' => $validated->errors()
                ], 401);
            }
    
            $comercio = Comercio::where("id_usuario", $id);
            if($comercio == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en hijo'
                ], 404);
            } 
    
            $updated = $exists->update([
                'usuario' => $request->usuario,
                'password' => bcrypt($request->password),
                'nombre' => $request->nombre,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'id_municipio' => $request->id_municipio,
                'telefono' => $request->telefono,
                'avatar' => $request->avatar
            ]);
    
            if(!$updated) {
                return response()->json([
                    'status' => 500,
                    'message' => 'El elemento con id '. $exists->id . ' no se ha podido actualizar'
                ], 500);
            }
    
            /* actualización del campo de comercios */
            
    
            if($comercio == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en hijo'
                ], 404);
            } 
    
            $updated = $comercio->update([
                'descripcion' => $request->descripcion,
                'id_usuario' => $id,
                'id_categoria' => $request->id_categoria
            ]);
    
            if(!$updated) {
                return response()->json([
                    'status' => 500,
                    'message' => 'El elemento con id '. $exists->id . ' no se ha podido actualizar'
                ], 500);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'Se ha actualizado el elemento '. $exists->id
            ], 200);
    
        }

        
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

          /**
    * @OA\Delete(
    *     path="/api/comercios/:id",
    *     summary="Borrar comercios",
    *     tags={"Comercios"},
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
    public function destroy($id)
    {
        if(!Auth()->user()->hasRole('admin')) return response()->json([
            'status' => 403,
            "message" => "No tienes permisos para borrar los elementos"
        ], 403);

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);


        if(!$id) {
            return response()->json([
                'status' => 404,
                'message' =>  'Id no encontrado en la petición'
            ], 404);
        }

        if($id != 1) {
            $exists = User::find($id);
            if($exists == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en la tabla usuarios'
                ], 404);
            } 
    
            $exists->delete($id);

            $exists = Comercio::where('id_usuario', $id);
            if($exists == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en la tabla comercio'
                ], 404);
            } 
    
            $exists->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Borrado el elemento id '. $id
            ], 200);

        } else {
            return response()->json([
                'status' => 403,
                'message' => 'No permitido'
            ], 403);
        }
      
    }
}
