<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Artist;
use App\Models\Venue;
use App\Models\EventTicket;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;

class EventController extends Controller
{
    function details($event_id, Request $request)
    {
        if ($request->query->has("gen")) {
            $faker = \Faker\Factory::create();

            $evs = Event::get();
            foreach ($evs as $ev) {
                $ev->name = $faker->realText($faker->numberBetween(10, 35));
                $ev->save();
            }
        }

        $event = Event::where(["id" => $event_id])->first();
        if (!$event) return abort(404);;
        $venue = Venue::where(["id" => $event->venue])->first();
        $artists = Artist::whereIn("id", $event->artists ?? [])->get();

        $tickets = EventTicket::where(["event_id" => $event->id])
            ->where('status', '!=', "CREATED")->get()->toArray();





        $event->has_tickets = false;
        $event->is_past = Carbon::parse($event->start_date . " 00:00:00")->lessThan(Carbon::today());
        $event->is_coming_soon = false;
        if ($tickets && sizeof($tickets) > 0) {
            $event->has_tickets = true;
            usort($tickets, function ($first, $second) {
                $first_time = strtotime($first["start_datetime"]);
                $second_time = strtotime($second["start_datetime"]);

                return $first_time > $second_time;
            });
            $event->start_datetime = $tickets[0]["start_datetime"];
            usort($tickets, function ($first, $second) {
                return $first["price"] > $second["price"];
            });
            $event->start_price = $tickets[0]["price"];

            $future_count = 0;
            foreach ($tickets as $ticket) {
                if (Carbon::parse($ticket["start_datetime"])->greaterThan(Carbon::now())) {
                    $future_count++;
                }
            }
            $event->is_past = $future_count === 0;
        } else if (!$event->is_past) {
            $event->is_coming_soon = true;
        } else {
            $event->is_coming_soon = false;
        }


        return response()->json([
            "message" => "Successful",
            "event" => $event,
            "venue" => $venue,
            "artists" => $artists
        ]);
    }

    function tickets($event_id, Request $request)
    {
        $tickets = EventTicket::where(["event_id" => $event_id])
            ->where('status', '!=', "CREATED")
            ->orderBy("start_datetime", "ASC")
            ->orderBy("price", "ASC")->get();

        $date_tickets = [];

        foreach ($tickets as $ticket) {
            $date = Carbon::parse($ticket["start_datetime"])->format("Y-m-d");
            $date_tickets[$date][] = $ticket;
        }

        return response()->json([
            "message" => "Successful",
            "date_tickets" => $date_tickets,
            "dates" => array_keys($date_tickets)
        ]);
    }

    function checkoutSession(Request $request)
    {
        $user = auth("api")->user();
        $key = $_ENV["RAZORPAY_KEY_ID"];
        $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);
        $event_id = $request->event_id;
        $event = Event::where(["id" => $event_id])->first();
        $items = $request->items;
        $name = $user->name;
        $mobile = $user->mobile;
        $email = $user->email;

        $order_details = [];
        $total_price = 0;
        foreach ($items as $item) {
            if (!isset($item["quantity"]) || $item["quantity"] > 0 == false) continue;
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

        //coupon
        $coupon_code = $request->coupon;
        $coupon = Coupon::where("code", $coupon_code)
            ->where("type", "%")
            ->where("remaining_count", ">", 0)->first();
        $discounted_amount = $total_price;
        $discount = 0;
        if ($coupon) {
            $coupon->remaining_count = $coupon->remaining_count - 1;

            $discount = ($coupon->discount / 100) * $total_price;
            $discounted_amount = $total_price - $discount;

            $coupon->save();
        }

        //create payment
        $payment = new Payment();
        $payment->rzp_order_id = "";
        $payment->payment_method = "Razorpay";
        $payment->order_id = 0;
        $payment->user = $name;
        $payment->phone = $mobile;
        $payment->email = $email;
        $payment->amount = $total_price;
        $payment->status = "CREATED";
        if ($coupon) {
            $payment->discount = $discount;
            $payment->coupon = $coupon->code;
        }
        $payment->save();

        //create order
        $order = new Order();
        $order->event_id = $request->event_id;
        $order->name = $name;
        $order->email = $email;
        $order->mobile = $mobile;
        $order->status = "PENDING";
        $order->total_price = $total_price;
        $order->payment_id = $payment->id;
        //$order->user_id = $user->id;
        if ($coupon) {
            $order->discount = $discount;
        }
        $order->save();

        //update order
        $order->payment_id = $payment->id;
        $order->save();

        //create razorpay payment
        $orderData = [
            'receipt'         => $order->id,
            'amount'          => round($discounted_amount * 100),
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
        return response()->json([
            "message" => "Successful",
            "url" => url("/api/events/checkout/pay?payment_id=$payment->id&order_id=$order->id&event_id=$event->id")
        ]);
    }

    public function checkoutPay(Request $request)
    {
        $payment_id = $request->query("payment_id");
        $order_id = $request->query("order_id");
        $event_id = $request->query("event_id");

        $event = Event::where("id", $event_id)->first();
        $order = Order::where("id", $order_id)->first();
        $payment = Payment::where("id", $payment_id)->first();

        $rzp_order_id = $payment->rzp_order_id;
        $key = $_ENV["RAZORPAY_KEY_ID"];
        $api = new Api($_ENV["RAZORPAY_KEY_ID"], $_ENV["RAZORPAY_KEY_SECRET"]);

        $razorpay_order = $api->order->fetch($rzp_order_id);

        return view("front.payment.razorpay.checkout",  [
            "order_details" => $razorpay_order,
            "key" => $key,
            "customer_details" => [
                "name" => $order->name,
                "email" => $order->email,
                "mobile" => $order->mobile
            ],
            "event" => $event
        ]);
    }
}
