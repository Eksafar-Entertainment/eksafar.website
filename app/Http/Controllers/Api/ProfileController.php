<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user_data = auth('api')->user();
        return response()->json([
            "message" => "User profile data",
            "data" => $user_data
        ]);
    }
    public function orders(Request $request)
    {
        $user = auth('api')->user();
        $orders = Order::where("user_id", $user->id)
        ->where("STATUS", "=", "SUCCESS")
            ->orderBy("created_at", "DESC")
            ->get();

        return response()->json([
            "message" => "User profile data",
            "orders" => $orders
        ]);
    }
}
