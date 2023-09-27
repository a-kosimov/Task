<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request)
   {
       $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|unique:users',
          'password'=>'required|string|min:6'
       ]);
       $user = User::create([
           'name' => $validatedData['name'],
           'email' =>$validatedData['email'],
           'password'=>Hash::make($validatedData['password'])
       ]);

       $token =$user->createToken('authToken')->accessToken;
       return response(['user'=>$user, 'access_token'=>$token]);
   }
}
