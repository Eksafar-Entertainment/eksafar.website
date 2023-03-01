<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
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
        try {
            $entries = $data->entry;
            $text = "Message from whatsapp" . PHP_EOL;
            $has_message = false;
            foreach ($entries as $entry) {
                $changes = $entry->changes;
                foreach ($changes as $change) {
                    $messages = $change->messages;
                    foreach ($messages as $message) {
                        $entity = "From : " . $message->from . PHP_EOL;
                        if ($message->type == "text") {
                            $entity .= "" . $message->text->body . PHP_EOL;
                        } else {
                            $entity .= $message->type . " message" . PHP_EOL;
                        }
                        $text .= $text . PHP_EOL;
                        $has_message = true;
                    }
                }
            }
            if ($has_message) {
                Mail::raw($text . PHP_EOL . PHP_EOL . PHP_EOL . "<pre>" . json_encode($data, JSON_PRETTY_PRINT) . "</pre>", function ($message) {
                    $message->to("webmaster@eksafar.club")
                        ->subject("Message from whatsapp");
                });
            }
        } catch (Exception $err) {
        }




        return response($challenge);
    }
}
