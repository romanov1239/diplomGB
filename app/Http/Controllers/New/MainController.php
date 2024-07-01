<?php

namespace App\Http\Controllers\New;

use App\Http\Controllers\Controller;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function users()
    {
        return User::get()->map( function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role->name,
                'email' => $user->email,
            ];
        });
    }

    public function user($id)
    {
        $user = User::find($id);

        return [
            'name' => $user->name,
            'role' => $user->role->name,
            'email' => $user->email,
        ];
    }
}
