<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(path: '/register', summary: 'Registro de nuevos clientes', tags: ['Autenticación'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name', 'email', 'password', 'password_confirmation'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Juan Pérez'),
                new OA\Property(property: 'email', type: 'string', example: 'juan@ejemplo.com'),
                new OA\Property(property: 'password', type: 'string', example: 'secreto123'),
                new OA\Property(property: 'password_confirmation', type: 'string', example: 'secreto123')
            ]
        )
    )]
    #[OA\Response(response: 201, description: 'Usuario registrado con éxito')]
    #[OA\Response(response: 422, description: 'Error de validación')]
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    #[OA\Post(path: '/login', summary: 'Inicio de sesión', tags: ['Autenticación'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['email', 'password'],
            properties: [
                new OA\Property(property: 'email', type: 'string', example: 'juan@ejemplo.com'),
                new OA\Property(property: 'password', type: 'string', example: 'secreto123')
            ]
        )
    )]
    #[OA\Response(response: 200, description: 'Sesión iniciada correctamente')]
    #[OA\Response(response: 401, description: 'Credenciales inválidas')]
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $user = User::where('email', $validated['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Sesión iniciada correctamente',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    #[OA\Post(path: '/logout', summary: 'Cierre de sesión', security: [['bearerAuth' => []]], tags: ['Autenticación'])]
    #[OA\Response(response: 200, description: 'Sesión cerrada correctamente')]
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}

