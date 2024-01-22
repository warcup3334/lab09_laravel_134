<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function register (Request $request) {

        $fileds = $request->validate([
        
        'name' => 'required|string',
        
        'email' => 'required|string|unique:users, email', 
        
        'password' => 'required|string|confirmed',
        
        'role' => 'required|integer'
        
        ]);
        
        $user = User::create([
        
        'name' => $fileds['name'],
        
        'email' => $fileds['email'],
        
        'password' => bcrypt($fileds['password']),
        
        'role' => $fileds['role'],
        
        ]);
        
        $token = $user->createToken($request->userAgent(), [$fileds['role']])->plainTextToken;
        
        $reponse = [
        
        'user' => $user,
        
        'token' => $token
        
        ];
        
        return response($reponse, 201);
        
        }
    
        public function login (Request $request) {
            $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            ]);
            
            $user = User:: where('email', $fields['email'])->first();
            if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([ 'message' => 'Invalid Login', 1], 401);
            } else {
           
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent(), ["$user->role"])->plainTextToken;
            $response = [
            'user' => $user,
            'token' => $token,
            ];
            return response($response, 200);
            }
        }
        public function logout (Request $request) { $request->user()->currentAccessToken()->delete(); // auth()->user()->tokens()->delete();
            return response([ 'message' => 'Logged Out', 1], 200);
            }
}
