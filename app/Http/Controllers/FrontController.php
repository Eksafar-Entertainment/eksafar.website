<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

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
        if($type == "performer") {
            return view('frontend.performer.index', compact('desktop', 'mobile', 'tablet', 'type'));
        };
        
        if($type == "about") {
            return view('frontend.about.index', compact('desktop', 'mobile', 'tablet','type'));
        };
        
        if($type == "program") {
            return view('frontend.program.index', compact('desktop', 'mobile', 'tablet','type'));
        };
        
        if($type == "venue") {
            return view('frontend.venue.index', compact('desktop', 'mobile', 'tablet','type'));
        };
        
        if($type == "elements") {
            return view('frontend.elements.index', compact('desktop', 'mobile', 'tablet','type'));
        };
        
        if($type == "upcomming") {
            return view('frontend.events.index', compact('desktop', 'mobile', 'tablet','type'));
        };
        
        if($type == "current") {
            return view('frontend.events.event.index', compact('desktop', 'mobile', 'tablet','type'));
        };

        if($type == "contact") {
            return view('frontend.contact.index', compact('desktop', 'mobile', 'tablet','type'));
        };
    }

}
