<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // USER REGISTER API - POST
    public function register(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "mobile" => "required",
            "password" => "required|confirmed"
        ]);
        // create user data + save
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();
        // send response
        return response()->json([
            "status" => 1,
            "message" => "User registered successfully"
        ], 200);
    }
    // USER LOGIN API - POST
    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        // verify user + token
        if (!$token = auth('api')->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                "message" => "Invalid credentials"
            ], 403);
        }
        // send response
        return response()->json([
            "message" => "Logged in successfully",
            "access_token" => $token
        ]);
    }
    // USER PROFILE API - GET
    public function profile()
    {
        $user_data = auth('api')->user();
        return response()->json([
            "message" => "User profile data",
            "data" => $user_data
        ]);
    }
    // USER LOGOUT API - GET
    public function logout()
    {
        auth('api')->logout();
        return response()->json([
            "message" => "User logged out"
        ]);
    }



    //social login
    public function social($provider, Request $request)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    //social login
    public function callback($provider, Request $request)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $pUser = User::where('email', $user->email)->first();
        $token = null;
        if ($pUser) {
            $token = auth('api')->login($pUser);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => encrypt('123456dummy')
            ]);
            $token = auth('api')->login($newUser);
        }
        //return redirect()->to(url("/api/auth/success?token=$token"));

        echo "<script>flutterChannel.postMessage('$token');</script>"; 
        // // send response
        // return response()->json([
        //     "message" => "Logged in successfully",
        //     "access_token" => $token
        // ]);
    }
}
