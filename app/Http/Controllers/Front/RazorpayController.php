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
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RazorpayController extends Controller
{
  function checkout(Request $request)
  {

    $user = Auth::guard("web")->user();
    $date = "";
    if ($request->date == '3') {
      $date = Carbon::create(2022, 10, 3, 0, 0, 0, 'Asia/Kolkata');
    }
    if ($request->date == '4') {
      $date = Carbon::create(2022, 10, 4, 0, 0, 0, 'Asia/Kolkata');
    }
    $key = $_ENV["RAZORPAY_KEY_ID"];
    $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);
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
    $payment->payment_method = "Razorpay";
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
    $order->date = $date;
    $order->email = $user->email;
    $order->mobile = $user->mobile;
    $order->status = "PENDING";
    $order->total_price = $total_price;
    $order->payment_id = $payment->id;
    $order->user_id = $user->id;
    $order->save();

    //update order
    $order->payment_id = $payment->id;
    $order->save();

    //create razorpay payment
    $orderData = [
      'receipt'         => $order->id,
      'amount'          => $total_price * 100,
      'currency'        => 'INR',
      'notes'           => [
        "order_id" => $order->id
      ]
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

    return view("payment.razorpay.checkout",  [
      "order_details" => $razorpay_order,
      "key" => $key,
      "customer_details" => [
        "name" => $user->name,
        "email" => $user->email,
        "mobile" => $user->mobile
      ]
    ]);
  }

  function checkoutComplete(Request $request)
  {
    $success = true;
    $error = "Payment Failed";
    if ($request->exists('razorpay_payment_id') === false) {
      abort(404);
    }
    $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);
    $payment = Payment::where(["rzp_order_id" => $request->razorpay_order_id])->first();
    if (!$payment) {
      abort(404);
    }

    if ($payment->status == "SUCCESS") {
      abort(404);
    }
    $order = Order::where(["payment_id" => $payment->id])->first();
    $order_details = OrderDetail::where(["order_details.order_id" => $order->id])
      ->leftJoin("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
      //->groupBy("order_details.id")
      ->select(
        "order_details.*",
        "event_tickets.name as event_ticket_name",
        "event_tickets.persons as event_ticket_persons"
      )
      ->get();
    $event = Event::where(["id" => $order->event_id])->first();

    try {
      $attributes = array(
        'razorpay_order_id' => $payment->rzp_order_id,
        'razorpay_payment_id' => $_POST['razorpay_payment_id'],
        'razorpay_signature' => $_POST['razorpay_signature']
      );
      $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
      $success = false;
      $error = 'Razorpay Error : ' . $e->getMessage();
    }

    $payment->rzp_payment_id = $request->razorpay_payment_id;

    if ($success === true) {
      $payment->status = "SUCCESS";
      $order->status = "SUCCESS";
      $html = "Your payment was successful";

      //generate tickets
      $order_details = OrderDetail::where("order_id", $order->id)->get();
      foreach ($order_details as $order_detail) {
        //for normal tickets
        if ($order_detail->event_ticket_id != null) {
          for ($i = 0; $i < $order_detail->quantity; $i++) {
            OrderDetailTicket::create([
              "order_detail_id" => $order_detail->id,
              "event_combo_ticket_id" => null,
              "event_ticket_id" => $order_detail->event_ticket_id,
            ]);
          }
        }

        //for combo tickets
        if ($order_detail->event_combo_ticket_id != null) {
          $combo_ticket_details = EventComboTicketDetail::where("event_combo_ticket_id", $order_detail->event_combo_ticket_id)->get();
          for ($i = 0; $i < $order_detail->quantity; $i++) {
            foreach ($combo_ticket_details as $combo_ticket_detail) {
              OrderDetailTicket::create([
                "order_detail_id" => $order_detail->id,
                "event_combo_ticket_id" => $order_detail->event_combo_ticket_id,
                "event_ticket_id" => $combo_ticket_detail->event_ticket_id,
              ]);
            }
          }
        }
      }

      //generate qrcode
      QrCode::format('png')->size(200)->generate($order->id, public_path("storage/uploads/qr-" . $order->id . ".png"));
      //send email
      Mail::to($order->email)->send(new TicketMail($event, $order, $order_details));
    } else {
      $payment->status = "FAILED";
      $order->status = "FAILED";
      $html = "Your payment failed";
    }

    $payment->save();
    $order->save();





    return view("payment.razorpay.success",  [
      "type" => $success ? "Order Placed" : "Payment Failed",
      "payment_id" => $payment->id,
      "content" => $success ? $html : $error,
      "success" => $success,
      "order" => $order
    ]);
  }

  public function webhook(Request $request)
  {
    Log::channel('rzp-webhook')->info(json_encode($request->all()));
  }
}
