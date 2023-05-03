<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        /* Validando todos os campos */
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        /* Recebendo todos os campos e criando o usuário novo */
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        /* Emitindo o token para acessar API */
        $token = $user->createToken($request->nameToken)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        /* Retornando o usuário criado e o token */
        return response($response, 201);
    }

    public function login(Request $request)
    {
        /* Recuperando e validando todos os campos */
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        /* Se tem algum usuário cadastrado com este email inserido pelo usuário */
        $user = User::where('email', $fields['email'])->first();

        /* Se existe o usuário, e se a sua senha(hash), confere
           com o que está no banco de dados */
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Email ou senha inválidos!'
            ], 401);

            /* Finalmente, se o usuário e a senha conferirem */
            /* Emitindo o token para acessar API */
            /* Um nome fixo para o token */
            $token = $user->createToken('UsuarioLogado')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            /* Retornando o usuário e o token, para utenticar com o mesmo */
            return response($response, 201);
        }
    }

    public function logout(Request $request)
    {
        /* Pegando o token que o usuário logado está usando
           para acessar este endpoint, e deletando ele. */
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Deslogado com sucesso.'
        ], 200);
    }
}
