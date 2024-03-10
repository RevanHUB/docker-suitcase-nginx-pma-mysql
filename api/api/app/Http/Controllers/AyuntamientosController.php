<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Ayuntamiento;
use App\Models\Token;
use App\Models\User;

class AyuntamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

               /**
    * @OA\Get(
    *     path="/api/ayuntamientos",
    *     summary="Mostrar ayuntamientos",
    *     tags={"Ayuntamientos"},
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


        $ayuntamientos = User::select(
            /* From Users */
            'users.id as id',
            /* From Ayuntamientos */
            'tokens.valor as token',
            'usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio'
        )
            ->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('ayuntamientos', 'ayuntamientos.id_usuario', 'users.id')
            ->join('tokens', 'ayuntamientos.id_token', 'tokens.id')
            ->get();

        if($ayuntamientos->isEmpty()) {
            return response()->json([
                'message' => "There's no content in records"
            ], 404);
        }

        return response()->json([   
            'ayuntamientos'=> $ayuntamientos
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
    *     path="/api/ayuntamientos/",
    *     summary="Crear ayuntamientos",
    *     tags={"Ayuntamientos"},
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
    public function store(Request $request)
    {

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(
            Auth::check()  && Auth()->user()->hasRole('admin') 
        ) {
            $validated = Validator::make($request->all(), [
                'usuario' => 'required|unique:users',
                'password' => 'required',
                'nombre' => 'required',
                'email' => 'required',
                'direccion' => 'required',
                'id_municipio' => 'required',
                'telefono' => 'required',
                'avatar' => 'nullable',
                'id_token' => 'required|integer'
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
            
            $token = Token::where('id', $request->id_token)
                ->where('usado', 0)
                ->get();
    
            if($token->isEmpty()) return response()->json([
                'status' => 401,
                'errors' => "Ese token ya está usado"
            ], 401);
    
            $usando_token = Token::find($request->id_token)
                ->update(['usado', 1]);
    
            if(!$usando_token) return response()->json([
                'status' => 500,
                'errors' => "No se ha podido cambiar el estado del token"
            ], 500);
    
            $ayuntamiento = Ayuntamiento::create([
                'id_usuario' => $created->id,
                'id_token' => $request->id_token
            ]);
    
            
            if(!$ayuntamiento){
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
    *     path="/api/ayuntamientos/:id",
    *     summary="Muestra el ayuntamiento por ID",
    *     tags={"Ayuntamientos"},
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
            /* From Ayuntamientos */
            'tokens.valor as token',
            'usuario', 
            'users.nombre', 
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio'
        )
            ->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('ayuntamientos', 'ayuntamientos.id_usuario', 'users.id')
            ->join('tokens', 'ayuntamientos.id_token', 'tokens.id')
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
    * @OA\Put(
    *     path="/api/ayuntamientos/:id",
    *     summary="Actualizar ayuntamientos",
    *     tags={"Ayuntamientos"},
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

        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(
            Auth::check()  && Auth()->user()->hasRole('admin') || 
            Auth::check()  && Auth()->user()->hasRole('ayuntamiento')
        ) {

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
                    'id_token' => 'required',
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
                    'id_token' => 'required',
                ]);
            }
      
            if($validated->fails()) {
                return response()->json([
                    'status' => 401,
                    'errors' => $validated->errors()
                ], 401);
            }
    
            $ayuntamiento = Ayuntamiento::where("id_usuario", $id);
            if($ayuntamiento == null) {
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
            
    
            if($ayuntamiento == null) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Id '.$id.' no existe en hijo'
                ], 404);
            } 
    
            $updated = $ayuntamiento->update([
                'id_usuario' => $id,
                'id_token' => $request->id_token
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
        } else {
            return response()->json([
                'status' => 403,
                "message" => "No tienes permisos para realizar la acción"
            ], 403);
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
    *     path="/api/ayuntamientos/:id",
    *     summary="Borrar ayuntamientos",
    *     tags={"Ayuntamientos"},
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

        if(Auth::check()  && Auth()->user()->hasRole('admin')) {
            
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

                $exists = Ayuntamiento::where('id_usuario', $id);
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
        };

    }
}
