<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
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
            "events.cover_image",
        ])
            ->where("orders.user_id", $user->id)
            ->join('events', 'orders.event_id', '=', 'events.id')
            ->where("orders.status", "!=", "PENDING")
            ->orderBy("orders.created_at", "DESC")
            ->paginate()->toArray();

        $order_details = OrderDetail::select([
            "order_details.id",
            "order_details.order_id",
            "order_details.quantity",
            "order_details.rate",
            "order_details.price",
            "event_tickets.name",
            "event_tickets.start_datetime",
            "event_tickets.end_datetime",
        ])
            ->whereIn("order_id", array_map(function ($order) {
                return $order["id"];
            }, $orders["data"]))
            ->join("event_tickets", "order_details.event_ticket_id", "=", "event_tickets.id")
            ->get()->toArray();

        $orders["data"] = array_map(function ($order) use ($order_details) {
            $_order_details = array_filter($order_details, function ($order_detail) use ($order) {
                return $order_detail["order_id"] == $order["id"];
            });
            $order["quantity"] = array_reduce(array_values($_order_details), function ($quantity, $order_detail) {
                $quantity += $order_detail["quantity"];
                return $quantity;
            }, 0);
            $order["event_datetime"] = array_values($_order_details)[0]["start_datetime"];
            $order["order_details"] = array_values($_order_details);
            return $order;
        }, $orders["data"]);



        return response()->json([
            "message" => "User profile data",
            "orders" => $orders
        ]);
    }
}
