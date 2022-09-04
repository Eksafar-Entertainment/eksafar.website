<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    function index()
    {
        $orders =  Order::paginate(20);
        return view("admin/order/listing", ["orders" => $orders]);
    }

    function details($orderId = 0)
    {
        $order = Order::where(["id" => $orderId])->first();
        $order_tickets = $orderId  > 0 ? OrderDetail::where(["order_id" => $orderId])->get() : null;
        return view("admin/order/details", [
            "order" => $order,
            "order_tickets" => $order_tickets
        ]);
    }
}
