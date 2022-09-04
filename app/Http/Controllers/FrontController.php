<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\EventTicket;

class FrontController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $type = '/';
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();   
        return view('welcome', compact('desktop', 'mobile', 'tablet', 'type'));
    }

    public function route($type)
    {
        $agent = new Agent();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();

        switch($type){
            case "performer" : {
                return view('frontend.performer.index', compact('desktop', 'mobile', 'tablet', 'type'));
            }
            
            case "about":{
                return view('frontend.about.index', compact('desktop', 'mobile', 'tablet','type'));
            }
            
            case "program":{
                return view('frontend.program.index', compact('desktop', 'mobile', 'tablet','type'));
            }
            
            case "venue":{
                return view('frontend.venue.index', compact('desktop', 'mobile', 'tablet','type'));
            }
        
            case "elements":{
                return view('frontend.elements.index', compact('desktop', 'mobile', 'tablet','type'));
            }
            
            case "upcomming":{
                return view('frontend.events.index', compact('desktop', 'mobile', 'tablet','type'));
            }
            
            case "current":{
                return view('frontend.events.event.index', compact('desktop', 'mobile', 'tablet','type'));
            }
    
            case "contact":{
                return view('frontend.contact.index', compact('desktop', 'mobile', 'tablet','type'));
            }

            default: return abort(404);
        }
        
    }

}
