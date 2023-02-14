<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Artist;
use App\Models\Venue;
use App\Models\EventTicket;
use Carbon\Carbon;

class EventController extends Controller
{
    function details($event_id, Request $request)
    {
        $event = Event::where(["id" => $event_id])->first();
        if (!$event) return abort(404);;
        $venue = Venue::where(["id" => $event->venue])->first();
        $artists = Artist::whereIn("id", $event->artists ?? [])->get();

        $tickets = EventTicket::where(["event_id" => $event->id])
            ->where('status', '!=', "CREATED")->get()->toArray();

        if ($request->query->has("gen")) {
            $faker = \Faker\Factory::create();

            $evs = Event::get();
            foreach ($evs as $ev) {
                $ev->name = $faker->realText($faker->numberBetween(10, 35));
                $ev->save();
            }
        }



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
            "tickets" => $date_tickets
        ]);
    }
}
