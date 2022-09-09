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
            
            case "gallery":{
                return view('frontend.gallery.index', compact('desktop', 'mobile', 'tablet','type'));
            }
            
            case "guest":{
                return view('frontend.guest.index', compact('desktop', 'mobile', 'tablet','type',));
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

            case "privacy":{
                return view('frontend.extra.privacy', compact('desktop', 'mobile', 'tablet','type'));
            }

            case "payment-policy":{
                return view('frontend.extra.payment-policy', compact('desktop', 'mobile', 'tablet','type'));
            }

            case "terms":{
                return view('frontend.extra.terms', compact('desktop', 'mobile', 'tablet','type'));
            }

            default: return abort(404);
        }
        
    }

}
