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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect("/admin");
        } else {
            return redirect("admin/login")->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    public function checkUserEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $user =  User::where("email", $request->email)->first();
        if ($user) {
            return response()->json([
                "status" => 200,
                'message' => 'User exist',
                'data' => [
                    "is_existing_user" => $user ? true : false
                ]
            ]);
        }
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
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                "status" => 200,
                'message' => 'User exist',
                'data' => $user
            ]);
        }
    }
}
