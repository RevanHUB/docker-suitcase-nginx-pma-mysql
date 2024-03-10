<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/* Models */
use App\Models\User;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="API Integracion", version="1.0")
 * 
 * @OA\Server(url="http://127.0.0.1:8000")
 * 
 */




class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function auth()
    {
        return response()->json([
            'status' => 200,
            'message' => 'Api works'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Mostrar usuarios",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Se mostraran todos los usuarios."
     *     ),
     *  @OA\Response(
     *         response=401,
     *         description="Necesitas loguear"
     *     ),
     *  @OA\Response(
     *         response=404,
     *         description="Contenido no encontrado"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *   security={
     *              {"sanctum": {}},
     *      },
     *     
     * )
     */
    public function index()
    {
        if (!Auth::check()) return response()->json([
            'status' => 401,
            'message' => "Necesitas logear"
        ], 401);

        $usuarios = User::select('users.id as id', 'usuario', 'users.nombre', 'direccion', 'email', 'telefono', 'avatar', 'municipios.nombre as municipio')
            ->join('municipios', 'municipios.id', 'users.id_municipio')
            ->get();
        if ($usuarios->isEmpty()) {
            return response()->json([
                'message' => "There's no content in records"
            ], 404);
        }
        return response()->json([
            'usuarios' => $usuarios
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
     *     path="/api/users",
     *     summary="Crear usuarios",
     *     tags={"Users"},
     * @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="usuario",
     *                 description="Nombre del usuario",
     *                 type="string",
     *                 example="documentacion_1"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 description="Correo electrónico del usuario",
     *                 type="string",
     *                 format="string",
     *                  example="documentacion_1@gmail.com"
     *             ),
     *             @OA\Property(
     *                 property="nombre",
     *                 description="Nombre del individuo",
     *                 type="string",
     *                 format="string",
     *                  example="documentacion_1"
     *             ),
     *              @OA\Property(
     *                 property="direccion",
     *                 description="Direccion del usuario",
     *                 type="string",
     *                 format="string",
     *                 example="Documentando una api"
     *             ),
     *  *             @OA\Property(
     *                 property="id_municipio",
     *                 description="Id del municipio",
     *                 type="integer",
     *                 format="integer",
     *                 example="1"
     *             ),
     *  *             @OA\Property(
     *                 property="password",
     *                 description="Password del usuario",
     *                 type="string",
     *                 format="password",
     *                  example="password"
     *             ),
     *  *             @OA\Property(
     *                 property="telefono",
     *                 description="Telefono del usuario",
     *                 type="integer",
     *                 format="integer",
     *                  example="123456789"
     *             ),
     *  *             @OA\Property(
     *                 property="avatar",
     *                 description="Avatar del usuario",
     *                 type="string",
     *                 format="ejemplo.png",
     *                  example="documentacion_1.png"
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Se ha creado el usuario."
     *     ),
     *   @OA\Response(
     *         response=401,
     *         description="Necesitas loguear"
     *     ),
     *  @OA\Response(
     *         response=404,
     *         description="Contenido no encontrado"
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
            'usuario' => 'required|unique:users',
            'password' => 'required',
            'nombre' => 'required',
            'email' => 'required|unique:users',
            'direccion' => 'required',
            'id_municipio' => 'required',
            'telefono' => 'required',
            'avatar' => 'nullable'
        ]);

        if ($validated->fails()) {
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
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Actualizar usuarios",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="usuario",
     *                  description="Nombre del usuario",
     *                  type="string",
     *                  example="documentacion_cambio",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  description="Contraseña del usuario",
     *                  type="password",
     *                  example="password",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="nombre",
     *                  description="Nombre identificativo",
     *                  type="string",
     *                  example="Documentacion Api",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  description="Nombre del usuario",
     *                  type="email",
     *                  example="documentacion_cambio@email.com",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="direccion",
     *                  description="Direccion del usuario",
     *                  type="string",
     *                  example="Documentacion Cambio Direccion",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="id_municipio",
     *                  description="Nombre del usuario",
     *                  type="string",
     *                  example="1",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="telefono",
     *                  description="Telefono del usuario",
     *                  type="string",
     *                  example="123456789",
     *                  
     *              ),
     *              @OA\Property(
     *                  property="avatar",
     *                  description="Avatar del usuario",
     *                  type="string",
     *                  example="documentacion.png",
     *                  
     *              ),
     *          ),
     * 
     *      ),
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del elemento a actualizar",
     *          required=true,
     *          example=14,
     *          @OA\Schema(type="integer", readOnly=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Se ha actualizado el usuario."
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="No se ha encontrado el id del usuario o el usuario."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Error de validacion del usuario."
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="No se ha podido realizar el cambio en el servidor."
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

        $exists = User::find($id);
        if ($exists == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Id ' . $id . ' no existe'
            ], 404);
        }

        /* hago comprobación de que se trabaje sobre el mismo usuario */
        if ($exists->usuario != $request->usuario && $exists->email != $request->email) {
            $validated = Validator::make($request->all(), [
                'usuario' => 'required|unique:users',
                'password' => 'required',
                'nombre' => 'required',
                'email' => 'required|unique:users',
                'direccion' => 'required',
                'id_municipio' => 'required',
                'telefono' => 'required',
                'avatar' => 'nullable'
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
                'avatar' => 'nullable'
            ]);
        }



        if ($validated->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => $validated->errors()
            ], 401);
        }


        $exists = User::find($id);


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
     *     path="/api/users/{id}",
     *     summary="Borra usuarios",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Se ha creado el usuario."
     *     ),
     *  @OA\Response(
     *         response=403,
     *         description="Error de permisos."
     *     ),
     *  @OA\Response(
     *         response=404,
     *         description="No se ha encontrado el elemento."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Necesitas loguear."
     *     ),
     *     
     *    @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID del elemento a eliminar",
     *          required=true,
     *          @OA\Schema(type="integer")
     *     ),
     *    security={
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
        if ($id == 1) return response()->json([
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
            $exists = User::find($id);
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
