<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\EventTicket;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $ticket_type = EventTicket::where(["event_id"=>1])->get();
        $type = '/';
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();   
        return view('welcome', compact('desktop', 'mobile', 'tablet', 'type', 'ticket_type'));
    }

    public function route($type)
    {
        $agent = new Agent();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();
        $ticket_type = EventTicket::where(["event_id"=>1])->get();

        switch($type){
            case "performer" : {
                return view('frontend.performer.index', compact('desktop', 'mobile', 'tablet', 'type', 'ticket_type'));
            }
            
            case "about":{
                return view('frontend.about.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
            
            case "program":{
                return view('frontend.program.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
            
            case "venue":{
                return view('frontend.venue.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
        
            case "elements":{
                return view('frontend.elements.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
            
            case "upcomming":{
                return view('frontend.events.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
            
            case "current":{
                return view('frontend.events.event.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }
    
            case "contact":{
                return view('frontend.contact.index', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }

            case "privacy":{
                return view('frontend.extra.privacy', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }

            case "payment_policy":{
                return view('frontend.extra.payment', compact('desktop', 'mobile', 'tablet','type', 'ticket_type'));
            }

            default: return abort(404);
        }
        
    }

}
