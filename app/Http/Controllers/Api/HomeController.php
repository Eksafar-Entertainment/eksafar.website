<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    //
    public function mainPage(Request $request)
    {
        $events = Event::join('venues', "events.venue", "=", "venues.id")
        ->select(["events.*", "venues.name as venue_name"])->orderBy('start_date', 'DESC')->get();

        return response()->json([
            "message" => "Successful",
            "events" => $events
        ]);
    }
}
