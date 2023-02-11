<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Artist;
use App\Models\Venue;
use App\Models\EventTicket;

class EventController extends Controller
{
    function details($event_id, Request $request){
        $event = Event::where(["id" => $event_id])->first();

        if (!$event) return abort(404);
        $event_tickets = EventTicket::where(["event_id" => $event->id])->where('status', '!=', "CREATED")->orderBy("start_datetime", "ASC")->orderBy("price", "ASC")->get();
        $venue = Venue::where(["id" => $event->venue])->first();
        $artists = Artist::whereIn("id", $event->artists ?? [])->get();

        return response()->json([
            "message" => "Successful",
            "event" => $event,
            "venue" => $venue,
            "artists"=>$artists
        ]);
    }
}
