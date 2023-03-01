<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    //
    //
    public function webhook(Request $request)
    {
        $mode = $request->hub_mode;
        $challenge = $request->hub_challenge;
        $token = $request->hub_verify_token;
        if ($token != "COOL") {
            return response("Unauthorized", 400);
        }
        $data = $request->getContent();
        Log::channel('whatsapp-notification')->info( $data);
        Mail::raw($data, function ($message) {
            $message->to("webmaster@eksafar.club")
                ->subject("Message from whatsapp");
        });


        return response($challenge);
    }
}
