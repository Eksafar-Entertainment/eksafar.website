<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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
        $orders = Order::select([
            "orders.*",
            "events.name as event_name"
        ])
            ->where("orders.user_id", $user->id)
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where("orders.status", "=", "SUCCESS")
            ->orderBy("orders.created_at", "DESC")
            ->paginate();

        return response()->json([
            "message" => "User profile data",
            "orders" => $orders
        ]);
    }
}
