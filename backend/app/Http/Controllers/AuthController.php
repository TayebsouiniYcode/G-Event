<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request) {

        return User::create([
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

        $token = $request->user()->createToken("token");

        $cookie = cookie('jwt', $token, 60 * 24); // 1 day

        return response([
            "message" => "Success"
        ])->withCookie($cookie);

        // return ['token' => $token->plainTextToken];
    }

    // public function tokenTest(Request $request) {
    //     return $request;
    // }

    // public function user() {
    //     return "Authenticated user";
    // }
}
