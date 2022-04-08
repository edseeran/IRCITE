<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{  
// REGISTER REPOSITORY
   public function register(Request $request){

    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
    ]);

    $user = User::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'clearance_level' => $data['clearance_level'],
    ]);

    $token = $user->createToken('User Password Grant Client')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token,
    ];

    return response($response, 200);

   }
// LOGOUT REPOSITORY
   public function logout(Request $request){
    $request->user()->tokens()->delete();
    return response(['message: Successfully logged out', 200]);
   }

// LOGIN REPOSITORY
   public function login(Request $request){

    $data = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6|confirmed',
        'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
    ]);

    $user = User::where('email', $data['email'])->first();

    if(!$user || !Hash::check($data['password'], $user->password)){

        return response(['message: Invalid credentials'], 401);
    }
    else
    {
        $token = $user->createToken('User Password Grant Client')->plainTextToken;
            
            $response = [
                'user' => $user,
                'token' => $token,
            ];
    
            return response($response, 200);
    }

   }

}
