<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = [
            "SUCCESS" => "success",
            "PENDING" => "warning",
            "FAILED" => "danger"
        ];
        $orders = Order::latest()
            ->leftJoin('promoters', function ($join) {
                $join->on('promoters.id', '=', 'orders.promoter_id');
            })
            //->groupBy('orders.id')
            ->select(
                "orders.*",
                "promoters.name as promoter",
                DB::raw("(orders.total_price * (promoters.commission/100)) as promoter_commission")
            )
            ->paginate(10);
        return view('admin.order.index', compact('orders', "colors"));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_details = OrderDetail::where(["order_id" => $order->id])
            ->leftJoin("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
            //->groupBy("order_details.id")
            ->select(
                "order_details.*",
                "event_tickets.name as event_ticket_name",
                "event_tickets.persons as event_ticket_persons"
            )
            ->get();
        return view('admin.order.show', [
            'order' => $order,
            'order_details' => $order_details
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->only('title', 'description', 'body'));

        return redirect()->route('orders.index')
            ->withSuccess(__('Order updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->withSuccess(__('Order deleted successfully.'));
    }

    public function checkInDetails(Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::where("id", $order_id)->first();
        $order_details = OrderDetail::where(["order_id" => $order->id])
        ->leftJoin("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
        //->groupBy("order_details.id")
        ->select(
            "order_details.*",
            "event_tickets.name as event_ticket_name",
            "event_tickets.persons as event_ticket_persons"
        )
        ->get();
        return response()->json([
            "status" => 200,
            'message'=>'Successfully fetched data',
            'html'=>view("admin.order.check-in-details", [
                'order' => $order,
                'order_details' => $order_details
            ])->render()
        ]);
    }

    public function checkIn(Request $request){
        $order_id = $request->order_id;
        $order = Order::where("id", $order_id)->first();
        $order->is_checked_in = true;
        $order->save();
        return response()->json([
            "status" => 200,
            'message'=>'Data updated successful',
        ]);
    }
}
