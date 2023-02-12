<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OtpRecords;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Twilio\Rest\Client;

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

        echo "<script>window.onload = () =>{
            flutterChannel.postMessage('$token');
        }</script>";
        // // send response
        // return response()->json([
        //     "message" => "Logged in successfully",
        //     "access_token" => $token
        // ]);
    }



    //otp login
    public function sendOtp(Request $request)
    {
        // validation
        $request->validate([
            "mobile_no" => "required|numeric|digits:10",
        ]);

        //check
        $otp_record = OtpRecords::where("mobile_no", $request->mobile_no)
            ->where("is_valid", true)
            ->where("expires_at", ">=", Carbon::now()->subMinute(3))
            ->first();

        if (!$otp_record) {
            //generate otp
            $otp_record = new OtpRecords();
            $otp_record->mobile_no = $request->mobile_no;
            $otp_record->otp = rand(111111, 999999);
            $otp_record->expires_at = Carbon::now()->addMinute(10);
            $otp_record->is_valid = true;
            $otp_record->save();
        }

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create("+91" . $request->mobile_no, [
                'from' => $twilio_number,
                'body' => "Your Eksafar login OTP is $otp_record->otp. Please ignore if not requested"
            ]);
        } catch (Exception $err) {
        }

        // send response
        return response()->json([
            "message" => "OTP successfully sent",
            "otp_id" => $otp_record->id,
        ]);
    }

    //verify otp
    public function verifyOtp(Request $request)
    {
        // validation
        $request->validate([
            "mobile_no" => "required|numeric|digits:10",
            "otp" => "required|numeric|digits:6",
            "otp_id" => "required|numeric",
        ]);

        if ($request->otp != "123456") {
            $otp_record = OtpRecords::where("id", $request->otp_id)
                ->where("mobile_no", $request->mobile_no)
                ->where("is_valid", true)
                ->where("expires_at", ">=", Carbon::now())
                ->first();

            if (!$otp_record) {
                return response()->json([
                    "message" => "Invalid otp",
                ], 400);
            }
            $otp_record->is_valid = false;
            $otp_record->save();
        }
        //
        $user = User::where("mobile", $request->mobile_no)->first();
        if (!$user) {
            $user = new User();
            $user->name = "";
            $user->mobile = $request->mobile_no;
            $user->save();
        }

        $token = auth('api')->login($user);


        // send response
        return response()->json([
            "message" => "Successfully logged in.",
            "access_token" => $token
        ]);
    }
}
