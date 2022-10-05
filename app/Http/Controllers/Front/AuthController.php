<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function checkUserEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $user =  User::where("email", $request->email)->first();

        return response()->json([
            "status" => 200,
            'message' => 'User exist',
            'data' => [
                "is_existing_user" => $user ? true : false
            ]
        ]);
    }

    public function tryLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user =  User::where("email", $request->email)->first();
        if ($user) {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::guard("web")->user();
                return response()->json([
                    "status" => 200,
                    'message' => 'User exist',
                    'data' => $user
                ]);
            } else {
                return response()->json([
                    "status" => 200,
                    'message' => 'Incorrect password',
                ]);
            }
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => bcrypt($request->password)
            ]);

            Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);

            return response()->json([
                "status" => 200,
                'message' => 'User exist',
                'data' => $user
            ]);
        }
    }
}
