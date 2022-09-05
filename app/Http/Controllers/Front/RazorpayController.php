<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Redirect,Response;
use Jenssegers\Agent\Agent;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index()
    {
      return view('payment.razorpay.index');
    }

    public function razorPaySuccess(Request $request){
        $data = [
                  'user' => $request->name,
                  'email' => $request->email,
                  'phone' => $request->phone,
                  'product_id' => $request->product_id,
                  'r_payment_id' => $request->razorpay_id,
                  'amount' => $request->amount,
               ];

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
