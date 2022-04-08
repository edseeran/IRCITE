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
   public function register(Request $request)
   {
    if (Auth::user()->clearance_level == 'superuser'){
    $data = $request->validate([
        'account_id' => 'required|unique:users|max:10',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
    ]);

    $user = User::create([
        'account_id' => $data['account_id'],
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
    elseif (Auth::user()->clearance_level == 'l1Admin'){
        $data = $request->validate([
            'account_id' => 'required|unique:users|max:10',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
        ]);
    
        $user = User::create([
            'account_id' => $data['account_id'],
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
    else{
        return response('Unauthorized', 401);
    }
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
    ]);

    $user = User::where('email', $data['email'])->first();

    if(!$user || !Hash::check($data['password'], $user->password)){

        return response(['message: Invalid credentials'], 404);
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

// LIST REPOSITORY
   public function list(){

    if (Auth::user()->clearance_level == 'superuser')
    {
        $users = User::all();
    }elseif(Auth::user()->clearance_level == 'l1Admin')
    {
        $users = User::all();

    }elseif(Auth::user()->clearance_level == 'l2Admin')
    {
        $users = User::all();

    }
    else{
        return response(['message: You do not have permission to view this page'], 401);
    }
    return response($users, 200);
    }
    
// SHOW REPOSITORY
    public function show($account_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $user = User::where('account_id', $account_id)->first();
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $user = User::where('account_id', $account_id)->first();
        }
        elseif(Auth::user()->clearance_level == 'l2Admin')
        {
            $user = User::where('account_id', $account_id)->first();
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response($user, 200);
    }

    // SHOW REPOSITORY
    public function delete($account_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $user = User::where('account_id', $account_id)->first();
            $user->delete();
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $user = User::where('account_id', $account_id)->first();
            $user->delete();
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response(['message: Account Deleted Successfully'], 200);
    }

    // UPDATE REPOSITORY
    public function update(Request $request, $account_id)
    {
        if(Auth::user()->clearance_level == 'superuser')
        {
            $user = User::where('account_id', $account_id)->first();
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
            ]);
            $user->update($data);
        }
        elseif(Auth::user()->clearance_level == 'l1Admin')
        {
            $user = User::where('account_id', $account_id)->first();
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'clearance_level' => 'required|string|in:superuser,l1Admin,l2Admin,l3Admin'
            ]);
            $user->update($data);
        }
        else{
            return response(['message: You do not have permission to view this page'], 401);
        }
        return response(['message: Account Updated Successfully'], 200);
    }
}