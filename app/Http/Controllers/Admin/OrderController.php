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

    function save($orderId = 0, Request $request)
    {
        $order = $orderId  > 0 ? Order::where(["id" => $orderId])->first() : new Order();

        $order->name = $request->name;
        $order->entry_type = $request->entry_type;
        $order->venue = $request->venue;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->occurrence = $request->occurrence;
        $order->description = $request->description;

        if ($request->file('cover_image')) {
            $file = $request->file('cover_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $filename);
            $order->cover_image = $filename;
        }
        $order->video_link = $request->video_link;
        $order->order_type = $request->order_type;
        $order->artist = $request->artist;
        $order->abilities = $request->abilities;

        $order->save();
        //save order details
        foreach($request->order_tickets as $ticket){
            

            if($ticket["name"] == "" && $ticket["price"]==""){
                if($ticket["id"] > 0){
                    OrderDetail::find($ticket["id"])->delete();
                }
                continue;
            }
            //continue;
            $order_ticket = $ticket["id"] > 0? OrderDetail::find($ticket["id"]) : new OrderDetail();
            $order_ticket->name = $ticket["name"]??"jfghkcjhjk";
            $order_ticket->price = $ticket["price"];
            $order_ticket->description = $ticket["description"];
            $order_ticket->order_id = $order->id;
            $order_ticket->save();
        }
        return redirect('/admin/order/form/'.$order->id);
    }
    function delete($orderId)
    {
        $order = Order::find($orderId);
        if ($order->delete($orderId)) {
            return redirect('/admin/order');
        }
        return redirect('/admin/order');
    }
}
