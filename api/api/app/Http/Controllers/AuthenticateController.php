<?php

namespace App\Http\Controllers;

use App\Models\Ayuntamiento;
use App\Models\Comercio;
use App\Models\Particular;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/login/",
     *     summary="Loguear en la API",
     *     tags={"Autenticación"},
     *     @OA\Response(
     *         response=200,
     *         description="Se ha completado la petición."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     *      
     * )
     */
    
    public function login(Request $request)
    {

        if ($request) {
            $validated = Validator::make($request->all(), [
                'usuario' => 'required',
                'password' => 'required'
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 403,
                    "message" => "no se ha podido validar los datos",
                    "content" => $validated->errors()
                ], 403);
            }

            $usuario = User::where("usuario", $request->usuario)->first();

            if (isset($usuario) && Hash::check($request->password, $usuario->password)) {
                $token = $usuario->createToken('my-app-token')->plainTextToken;
                $role = "";

                $isParticular = Particular::where('id_usuario', $usuario->id)->exists();

                $isAyuntamiento = Ayuntamiento::where('id_usuario', $usuario->id)->exists();

                $isComercio = Comercio::where('id_usuario', $usuario->id)->exists();

                $isAdmin = $usuario->id == 1;


                if ($isParticular) {
                    $usuario->assignRole('particular');
                    $role = "Particular";
                };
                if ($isComercio) {
                    $usuario->assignRole('comercio');
                    $role = "Comercio";
                };
                if ($isAyuntamiento) {
                    $usuario->assignRole('ayuntamiento');
                    $role = "Ayuntamiento";
                };
                if ($isAdmin) {
                    $usuario->assignRole('admin');
                    $role = "Admin";
                };

                $response = [
                    'mensaje' => 'Se ha logueado correctamente',
                    'usuario_validado' => $usuario->usuario,
                    'role' => $role,
                    'token' => $token
                ];

                return response($response, 201);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "No se ha encontrado el usuario o la contrasena es incorrecta"
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => "No puedes acceder"
            ], 401);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Se ha deslogueado'
        ], 200);
    }
}
