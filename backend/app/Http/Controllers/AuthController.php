<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Models\User;
use App\services\AuthService;
use App\utils\ReponseEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request) {

        return $user =  User::create([
            "firstname" => $request->input("firstname"),
            "lastname" => $request->input("lastname"),
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password"))
        ]);
    }

    public function login(Request $request) {

        if(!Auth::attempt($request->only("email", "password"))) {
            return response([
                'message' => "Invalid credentials !"
            ], Response::HTTP_UNAUTHORIZED);
        }

        //$token = $request->user()->createToken("token", ['server:update']);
        $token = $request->user()->createToken("token");

        return ['token' => $token->plainTextToken];
    }

    public function logout(Request $request) {
        //TODO Logout
    }
}
