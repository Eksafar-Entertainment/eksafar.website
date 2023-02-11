<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function appData(Request $request)
    {
        $locations = Location::get();

        return response()->json([
            "message" => "Successful",
            "locations" => $locations
        ]);
    }
    //
    public function mainPage(Request $request)
    {
        $location = $request->query("location");
        $upcoming_events = Event::where('start_date', '>=', Carbon::today())
            ->where("events.location", "=", $location)
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])
            ->orderBy('start_date', 'DESC')->get();

        $past_events = Event::limit(6)
            ->where('start_date', '<', Carbon::today())
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])
            ->orderBy('start_date', 'DESC')->get();


        return response()->json([
            "message" => "Successful",
            "upcoming_events" => $upcoming_events,
            "past_events" => $past_events,
            "location"=>$location
        ]);
    }
}
