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
use App\Models\EventTicket;

class RazorpayController extends Controller
{
  public function index()
  {
    return view('payment.razorpay.index');
  }

  function checkout(Request $request)
  {
    $key = $_ENV["RAZORPAY_KEY_ID"];
    $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);
    $event_id = $request->event_id;
    $items = $request->items;

    $order_details = [];
    $total_price = 0;
    foreach ($items as $item) {
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
    $payment->payment_method = "Razorpay";
    $payment->order_id = 0;
    $payment->user = $request->name;
    $payment->phone = $request->mobile;
    $payment->email = $request->email;
    $payment->amount = $total_price;
    $payment->status = "CREATED";
    $payment->save();

    //create order
    $order = new Order();
    $order->event_id = $request->event_id;
    $order->name = $request->name;
    $order->email = $request->email;
    $order->mobile = $request->mobile;
    $order->status = "PENDING";
    $order->total_price = $total_price;
    $order->payment_id = $payment->id;
    $order->save();

    //update order
    $order->payment_id = $payment->id;
    $order->save();

    //create razorpay payment
    $orderData = [
      'receipt'         => $order->id,
      'amount'          => $total_price * 100,
      'currency'        => 'INR'
    ];
    $razorpay_order = $api->order->create($orderData);

    //update payment
    $payment->order_id = $order->id;
    $payment->rzp_order_id = $razorpay_order->id;
    $payment->save();

    //save order details
    foreach ($order_details as $order_detail) {
      $order_detail->order_id = $order->id;
      $order_detail->save();
    }

    return view("payment.checkout",  [
      "order_details" => $razorpay_order,
      "key" => $key,
      "customer_details" => [
        "name" => $request->name,
        "email" => $request->email,
        "mobile" => $request->mobile
      ]
    ]);
  }
  function checkoutComplete(Request $request)
  {
    $success = true;
    $error = "Payment Failed";
    if ($request->exists('razorpay_payment_id') != false) {
      $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);
      $payment = Payment::where(["rzp_order_id"=>$request->razorpay_order_id])->first();
    $order = Order::where(["payment_id"=>$payment->id])->first();
      try {
        $api->utility->verifyPaymentSignature($request);
      } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
      }
    }

    
    $payment->rzp_payment_id = $request->razorpay_payment_id;
    if ($success === true) {
      $payment->status = "SUCCESS";
      $order->status = "SUCCESS";
      $html = "<p>Your payment was successful</p>
             <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
    } else {
      $payment->status = "FAILED";
      $order->status = "FAILED";
      $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
    }

    $payment->save();
    $order->save();

    echo $html;
  }
}
