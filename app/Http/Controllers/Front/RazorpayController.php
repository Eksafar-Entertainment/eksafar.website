<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Redirect,Response;
use Jenssegers\Agent\Agent;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;

class RazorpayController extends Controller
{
    public function index()
    {
      return view('payment.razorpay.index');
    }

    public function razorPayStarted(Request $request){
         
        $order = new Order;
        $order->name = $request->name;
        $order->mobile = $request->mobile;
        $order->email = $request->email;
        $order->event_id = '1';
        $order->payment_id = 'pending';
        $order->total_price = $request->amount;
        $order->payment_status= 'pending';

        $order->save();

        $oderDetail = new OrderDetail;
        $oderDetail->order_id = "pending";
        $oderDetail->event_ticket_id = $order->id;
        $oderDetail->quantity = $request->name;
        $oderDetail->details = json_encode($request->details);
        $oderDetail->amount = $request->amount;

        $oderDetail->save();

        $getId = Payment::insertGetId($data);  
        $getId->save();

        $arr = array('msg' => 'Payment successfully credited', 'status' => true, 'order_id' => $order->id, 'order_details_id' => $oderDetail->id);

        return Response()->json($arr);  
    }

    public function razorPaySuccess(Request $request){

        $data = [
          'user' => $request->name,
          'email' => $request->email,
          'phone' => $request->phone,
          'product_id' => $request->product_id,
          'r_payment_id' => $request->razorpay_id,
          'amount' => $request->amount,
          'payemt_method'=> 'razorpay',
        ];

        $order = Order::where('id', $request->order_id)->get();
        $order->name = $request->name;
        $order->mobile = $request->mobile;
        $order->email = $request->email;
        $order->event_id = '1';
        $order->payment_id = $request->razorpay_id;
        $order->total_price = $request->amount;
        $order->payment_status= 'success';

        $order->save();

        $oderDetail = OrderDetail::where('id', $request->order_details_id)->get();
        $oderDetail->order_id = "success";
        $oderDetail->event_ticket_id = $order->id;
        $oderDetail->quantity = $request->name;
        $oderDetail->price = $request->amount;

        $oderDetail->save();

        $getId = Payment::insertGetId($data);  
        $getId->save();

        $arr = array('msg' => 'Payment successfully credited', 'status' => true);

        return Response()->json($arr);    
    }

    public function paymentSuccess($id)
    {
      $payment = Payment::where('r_payment_id', $id)->first();
      $type= "Congrats!";
      $agent = new Agent();
      $desktop = $agent->isDesktop();
      $mobile = $agent->isMobile();
      $tablet = $agent->isTablet();
      // dd($payment);
      // $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
      // dd($api->qrCode->all(["payment_id" => $payment->r_payment_id]));
      // https://api.razorpay.com/v1/payments/qr_codes?payment_id=pay_KDkb3fEU0MAIHa

      return view('payment.razorpay.success',compact('payment', 'type', 'desktop', 'mobile', 'tablet'));
    }
}
