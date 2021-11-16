<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserloginRequest;
use App\Http\Resources\UserResource as UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return response()->json(["message" => "success", "response" => $response], 201);
    }

    public function login(UserloginRequest $request)
    {

        $user = User::where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json([
                'message' => 'error',
                "response" => "Bad credentials"
            ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return response()->json(["message" => "success", "response" => $response], 200);
    }

    public function logout(Request $request)
    {
        if (auth()->user()) {
            auth()->user()->tokens()->delete();
        }
        return response()->json([
            'message' => 'success',
            "response" => "Logged out",

        ], 200);
    }
}
