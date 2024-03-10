<?php

namespace App\Http\Controllers;

use App\Models\Particular;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ParticularesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

               /**
    * @OA\Get(
    *     path="/api/particulares/",
    *     summary="Mostrar particulares",
    *     tags={"Particulares"},
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


        $particulares = User::select(
            /* From Users */
            'users.id as id',
            'usuario', 
            'users.nombre', 
            /* From Particulares */
            'particulares.apellidos as apellidos',
            'particulares.edad as edad',
            'particulares.sexo as sexo',
            'particulares.fecha_nacimiento as fecha_nacimiento',
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio',
            )->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('particulares', 'particulares.id_usuario', 'users.id')
            ->get();

            if($particulares->isEmpty()) {
                return response()->json([
                    'message' => "There's no content in records"
                ], 404);
            }
    
            return response()->json([   
                'particulares'=> $particulares
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
    *     path="/api/particulares/",
    *     summary="Crear particular",
    *     tags={"Particulares"},
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

        $validated = Validator::make($request->all(), [
            'usuario' => 'required|unique:users',
            'password' => 'required',
            'nombre' => 'required',
            'email' => 'required|unique:users',
            'direccion' => 'required',
            'id_municipio' => 'required',
            'telefono' => 'required',
            'avatar' => 'nullable',
            'apellidos' => 'required',
            'sexo' => 'required',
            'edad' => 'required',
            'fecha_nacimiento' => 'required|date'
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

        $particular = Particular::create([
            'id_usuario' => $created->id,
            'apellidos' => $request->apellidos,
            'sexo' => $request->sexo,
            'edad' => $request->edad,
            'fecha_nacimiento' => $request->fecha_nacimiento
        ]);

        
        if(!$particular){
            return response()->json([
                'status' => 500,
                'errors' => $created->errors()
            ], 500);
        }

        return response()->json([
            'status' => 200,
            // 'message' => "Se ha creado el elemento con id " .$particular->id  /* id del particular*/
            'message' => "Se ha creado el elemento con id " .$created->id
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
    *     path="/api/particulares/:id",
    *     summary="Mostrar particular por ID",
    *     tags={"Particulares"},
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
            'usuario', 
            'users.nombre', 
            /* From Particulares */
            'particulares.apellidos as apellidos',
            'particulares.edad as edad',
            'particulares.sexo as sexo',
            'particulares.fecha_nacimiento as fecha_nacimiento',
            'direccion', 
            'email', 
            'telefono', 
            'avatar', 
            'municipios.nombre as municipio',
            )->join('municipios', 'municipios.id', 'users.id_municipio')
            ->join('particulares', 'particulares.id_usuario', 'users.id')
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
            'particular' => $exists
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
    *     path="/api/particulares/:id",
    *     summary="Actualizar particulares",
    *     tags={"Particulares"},
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
            Auth::check()  && Auth()->user()->hasRole('particular')) {
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
                        'apellidos' => 'required',
                        'sexo' => 'required',
                        'edad' => 'required',
                        'fecha_nacimiento' => 'required|date'
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
                        'apellidos' => 'required',
                        'sexo' => 'required',
                        'edad' => 'required',
                        'fecha_nacimiento' => 'required|date'
                    ]);
                }
          
                if($validated->fails()) {
                    return response()->json([
                        'status' => 401,
                        'errors' => $validated->errors()
                    ], 401);
                }
        
                $particular = Particular::where("id_usuario", $id)->first();
                if($particular == null) {
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
                
        
                if($particular == null) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Id '.$id.' no existe en hijo'
                    ], 404);
                } 
        
                $updated = $particular->update([
                    'id_usuario' => $id,
                    'apellidos' => $request->apellidos,
                    'sexo' => $request->sexo,
                    'edad' => $request->edad,
                    'fecha_nacimiento' => $request->fecha_nacimiento
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
    *     path="/api/particulares/:id",
    *     summary="Borrar particulares",
    *     tags={"Particulares"},
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
        if(!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        if(!Auth()->user()->hasRole('admin')) return response()->json([
            'status' => 403,
            "message" => "No tienes permisos para borrar los elementos"
        ], 403);

        if(Auth::check()  && Auth()->user()->hasRole('admin')) 
        {
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
    
                $exists = Particular::where('id_usuario', $id);
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
}
