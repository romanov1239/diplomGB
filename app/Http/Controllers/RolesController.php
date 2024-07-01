<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RolesController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string',

        ]);

        $user = User::create([
            'name' => $validatedData['login'], // Assuming 'name' field in your table represents 'login'
            'password' => Hash::make($validatedData['password']),

        ]);

        return response()->json($user);
    }




    public function index(): \Illuminate\Http\JsonResponse
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function create(Request $request)
    {
        Role::create($request->only('name'));


        return response()->json(true);
    }
    public function update(Request $request, Role $role)
    {
        $role->update($request->only('name'));


        return response()->json($role);
    }
    public function users(Role $role)
    {
        return $role->users;
    }
    //
}
