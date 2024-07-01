<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();
        return response()->json($users);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('login');
            $user->password = Hash::make($request->input('password'));
            $user->role_id = $request->input('role_id');
            $user->save();

            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Пользователь не найден'], 404);
        }
    }
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'Пользователь успешно удален'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка при удалении пользователя'], 500);
        }
    }


    //
}
