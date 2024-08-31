<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email')
            ->withTrashed()
            ->paginate(10);

        return [
            'status' => 200,
            'message' => 'Usuários encontrados!!',
            'users' => $users
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->validated();  // Use validated data

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 201,
            'message' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $data = $request->validated(); 

        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null
            ];
        }

        $user->update($data);

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!!',
            'user' => $user
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null
            ];
        }

        $user->delete();

        return [
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!!'
        ];
    }
}
