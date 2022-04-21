<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
        $registration = $request->value([
            'name' => 'required|string',
            'eamil' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
            ]
        );
        $user = User::create([
            'name' => $registration['name'],
            'email' => $registration['email'],
            'password' => $registration['password']
        ]);
    }
}
