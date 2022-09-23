<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTicket;
use Jenssegers\Agent\Agent;

class EventController extends Controller
{
    function details($eventSlug){
        $type = "Event Details";
        $agent = new Agent();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();

        $event = Event::where(["slug"=>$eventSlug])->first();
        if(!$event) return abort(404);
        $event_tickets= EventTicket::where(["event_id"=>$event->id])->get();
        return view("frontend.event.details", compact('desktop', 'mobile', 'tablet', 'type','event_tickets','event'));
    }
}
