<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Redirect, Response;
use Jenssegers\Agent\Agent;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use App\Mail\TicketMail;
use App\Models\Event;
use App\Models\EventComboTicketDetail;
use App\Models\EventTicket;
use App\Models\OrderDetailTicket;
use App\Models\Promoter;
use App\Models\Venue;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CashfreeController extends Controller
{
    function headers()
    {
        return [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-api-version' => '2022-01-01',
            "x-client-id" => $_ENV["CASHFREE_APP_ID"],
            'x-client-secret' => $_ENV["CASHFREE_SECRET_KEY"]
        ];
    }
    function checkout(Request $request)
    {

        $user = Auth::guard("web")->user();
        $event_id = $request->event_id;
        $promoter_id = $request->promoter_id;
        $promoter = Promoter::where(["id" => $promoter_id])->first();
        $items = $request->items;

        $order_details = [];
        $total_price = 0;
        foreach ($items as $item) {
            if ($item["quantity"] > 0 == false) continue;
            $event_ticket = EventTicket::where(["id" => $item["event_ticket_id"]])->first();
            $amount = $event_ticket->price * $item["quantity"];
            $total_price += $amount;

            $order_detail = new OrderDetail();
            $order_detail->event_ticket_id = $item["event_ticket_id"];
            $order_detail->quantity = $item["quantity"];
            $order_detail->price = $amount;
            $order_detail->rate = $event_ticket->price;

            $order_details[] = $order_detail;
        }

        //create payment
        $payment = new Payment();
        $payment->rzp_order_id = "";
        $payment->payment_method = "Cashfree";
        $payment->order_id = 0;
        $payment->user = $user->name;
        $payment->phone = $user->mobile;
        $payment->email = $user->email;
        $payment->amount = $total_price;
        $payment->status = "CREATED";
        $payment->save();

        //create order
        $order = new Order();
        $order->event_id = $request->event_id;
        $order->promoter_id = $promoter ? $promoter->id : null;
        $order->name = $user->name;
        $order->email = $user->email;
        $order->mobile = $user->mobile;
        $order->status = "PENDING";
        $order->total_price = $total_price;
        $order->payment_id = $payment->id;
        $order->user_id = $user->id;
        $order->save();

        //update order details
        foreach ($order_details as $order_detail) {
            $order_detail->order_id = $order->id;
            $order_detail->save();
        }

        //update order
        $order->payment_id = $payment->id;
        $order->save();

        //create api order
        $body = [
            "order_id" => "$order->id",
            "order_amount" => $order->total_price,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => "$user->id",
                "customer_email" => $user->email,
                "customer_phone" => $user->mobile,
            ],
            "order_meta" => [
                "return_url" => route("payment:cashfree:complete") . "?order_id={order_id}&order_token={order_token}",
                "notify_url" => route("payment:cashfree:webhook")
            ],
            //"order_expiry_time" => "2022-10-27T10:20:12+05:30",
            "order_note" => "Test order",
            "order_tags" => [
                "additionalProp" => "string"
            ],

        ];
        $cf_response = Http::withHeaders($this->headers())->post($_ENV["CASHFREE_BASE_URL"] . '/orders', $body);
        $cf_response_body = $cf_response->json();

        //dd($cf_response_body);

        //update payment
        $payment->order_id = $order->id;
        $payment->cf_order_id = $cf_response_body["cf_order_id"];
        $payment->save();


        return redirect($cf_response["payment_link"]);
    }

    public function complete(Request $request)
    {
        $order_id = $request->order_id;

        $cf_order_request = Http::withHeaders($this->headers())->get($_ENV["CASHFREE_BASE_URL"] . '/orders/' . $order_id);
        $cf_order = $cf_order_request->json();

        //$payment = Payment::where("order_id", $order_id)->first();
        $order = Order::where("id", $order_id)->first();

        $status = "PENDING";
        if ($cf_order["order_status"] === "PAID") {
            //$order->status = "SUCCESS";
            //$payment->status = "SUCCESS";
            $status = "SUCCESS";
        } else if ($cf_order["order_status"] === "EXPIRED") {
            //$order->status = "FAILED";
            //$payment->status = "FAILED";
            $status = "FAILED";
        }

        //$payment->save();
        //$order->save();

        return view("front.payment.complete",  [
            "status" => $status,
            "order" => $order
        ]);
    }

    public function webhook(Request $request)
    {
        Log::channel('payment-notification')->info(json_encode($request->all(), JSON_PRETTY_PRINT));
        //handle payment captured
        $cf_payment_id = $request->data["payment"]["cf_payment_id"];
        $order_id = $request->data["order"]["order_id"];
        $payment = Payment::where(["order_id" => $order_id])->first();
        if (!$payment) {
            abort(404);
        }
        $order = Order::where(["payment_id" => $payment->id])->first();
        $payment->rzp_payment_id = $cf_payment_id;
        if ($request->type === "PAYMENT_SUCCESS_WEBHOOK") {
            $payment->status = "SUCCESS";
            $order->status = "SUCCESS";
            //send email
            try {
                Mail::to($order->email)->send(new TicketMail($order->id));
            } catch (Exception $err) {
                print_r($err);
            }
        }
        if ($request->type === "PAYMENT_FAILED_WEBHOOK") {
            $payment->status = "FAILED";
            $order->status = "FAILED";
        }
        $payment->save();
        $order->save();
        return [
            $order, 
            $payment
        ];
    }
}
