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
            "events.name as event_name",
            "event_tickets.start_datetime as event_datetime"
        ])
            ->where("orders.user_id", $user->id)
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('event_tickets', 'order_details.event_ticket_id', '=', 'event_tickets.id')
            ->where("orders.status", "=", "SUCCESS")
            ->orderBy("orders.created_at", "DESC")
            ->paginate();

        return response()->json([
            "message" => "User profile data",
            "orders" => $orders
        ]);
    }
}
