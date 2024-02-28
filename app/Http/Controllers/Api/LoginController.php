<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $token = Auth::user()->createToken("access_token", ['*'], now()->addDay(1))->plainTextToken;

            return response()->json([
                "message" => "Login successfully",
                "token" => $token,
                "user" => new UserResource(Auth::user())
            ], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout() {
        if(Auth::check()) {
            Auth::user()->tokens()->delete();
            return response()->json(["message"=>"Logged out succcessfully"], Response::HTTP_NO_CONTENT);
        } else {
            return response()->json(["message"=>"User is already logged out"], Response::HTTP_BAD_REQUEST);
        }
    }
}
