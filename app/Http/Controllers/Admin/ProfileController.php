<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(Request $request){
        $user = Admin::where("id", auth("admin")->id())->first();
        return view("admin.profile", ["user"=>$user]);
    }

    public function update(Request $request){
        Admin::where("id", auth("admin")->id())->update($request->only("name", "email"));
        return redirect("/admin/profile")->with('message', 'Successfully profile updated!');   
    }

    public function changePassword(Request $request){
        $user = Admin::where("id", auth("admin")->id())->first();
        $validated = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => ['required'],
            'confirm_password' => 'required|same:new_password',
        ]);   
        return redirect("/admin/profile")->with('message', 'Successfully password changed!');  
    }
}
