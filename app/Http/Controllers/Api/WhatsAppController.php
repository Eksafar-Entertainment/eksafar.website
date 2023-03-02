<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
            $text = "Message from whatsapp\n";
            $has_message = false;
            foreach ($entries as $entry) {
                $changes = $entry->changes;
                foreach ($changes as $change) {
                    $messages = $change->value->messages;
                    foreach ($messages as $message) {
                        $entity = "From : <a href='https://wa.me/".$message->from."'>".$message->from."</a>\n";
                        if ($message->type == "text") {
                            $entity .= "<strong>Text : " .$message->text->body."</strong>\n";
                        } else {
                            $entity .= "<i>" .$message->type . " message" ."</i>\n";
                        }
                        $text .= $entity;
                        $has_message = true;
                    }
                }
            }
          
            if ($has_message) {
                Http::post("https://api.telegram.org/bot" . env("TELEGRAM_BOT_TOKEN") . "/sendMessage", [
                    "chat_id" => env("TELEGRAM_CHAT_ID"),
                    "text" => $text,
                    "parse_mode" => "HTML"
                ]);
            }
            dd($text);
        } catch (Exception $err) {
            print "Error" . $err->getMessage();
        }




        return response($challenge);
    }
}
