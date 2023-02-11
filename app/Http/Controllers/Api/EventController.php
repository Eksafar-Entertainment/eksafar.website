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
    function details($event_id, Request $request)
    {
        $event = Event::where(["id" => $event_id])->first();

        if (!$event) return abort(404);
        $event_tickets = EventTicket::where(["event_id" => $event->id])->where('status', '!=', "CREATED")->orderBy("start_datetime", "ASC")->orderBy("price", "ASC")->get();
        $venue = Venue::where(["id" => $event->venue])->first();
        $artists = Artist::whereIn("id", $event->artists ?? [])->get();

        if ($request->query->has("gen")) {
            $ds = [
                "Vh1 Supersonic",
                "SteppinOut Music Festival (SMF) Arena presents FKJ India Tour | Mumbai",
                "Vh1 Supersonic Arcade ft Camelphat - Bangalore",
                "Vh1 Supersonic Main Stage Bangalore",
                "Vh1 Supersonic Arcade ft Camelphat - Bangalore",
                "Far Out Left"
            ];
            $evs = Event::get();
            foreach ($evs as $ev) {
                $k = array_rand($ds);
                $ev->name = $ds[$k];
                $ev->save();
            }
        }

        return response()->json([
            "message" => "Successful",
            "event" => $event,
            "venue" => $venue,
            "artists" => $artists,
            "event_tickets" => $event_tickets
        ]);
    }
}
