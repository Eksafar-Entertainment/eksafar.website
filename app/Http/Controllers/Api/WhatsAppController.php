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
        // if ($token != "COOL") {
        //     return response("Unauthorized", 400);
        // }
        $data = json_decode($request->getContent());

        Log::channel('whatsapp-notification')->info(json_encode($data, JSON_PRETTY_PRINT));
        Mail::raw("<pre>".json_encode($data, JSON_PRETTY_PRINT)."</pre>", function ($message) {
            $message->to("webmaster@eksafar.club")
                ->subject("Message from whatsapp");
        });


        return response($challenge);
    }
}
