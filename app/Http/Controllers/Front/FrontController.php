<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\EventTicket;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $type = '/';
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();  
        $gallery = GalleryImage::latest()->select(["*", DB::raw('CONCAT("'.url("/storage/uploads").'/", path) as url')])->get(); 
        return view('welcome', compact('desktop', 'mobile', 'tablet', 'type', 'gallery'));
    }

    public function route($path)
    {
        $agent = new Agent();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();

        switch($path){
            case "performer" : {
                return view('frontend.performer.index', compact('desktop', 'mobile', 'tablet', 'path'));
            }
            
            case "about":{
                return view('frontend.about.index', compact('desktop', 'mobile', 'tablet','path'));
            }
            
            case "gallery":{
                return view('frontend.gallery.index', compact('desktop', 'mobile', 'tablet','path'));
            }
            
            case "guest":{
                return view('frontend.guest.index', compact('desktop', 'mobile', 'tablet','path',));
            }
        
            case "elements":{
                return view('frontend.elements.index', compact('desktop', 'mobile', 'tablet','path'));
            }
            
            case "upcomming":{
                return view('frontend.events.index', compact('desktop', 'mobile', 'tablet','path'));
            }
            
            case "current":{
                return view('frontend.events.event.index', compact('desktop', 'mobile', 'tablet','path'));
            }
    
            case "contact":{
                return view('frontend.contact.index', compact('desktop', 'mobile', 'tablet','path'));
            }

            case "privacy":{
                return view('frontend.extra.privacy', compact('desktop', 'mobile', 'tablet','path'));
            }

            case "payment-policy":{
                return view('frontend.extra.payment-policy', compact('desktop', 'mobile', 'tablet','path'));
            }

            case "terms":{
                return view('frontend.extra.terms', compact('desktop', 'mobile', 'tablet','path'));
            }

            default: return abort(404);
        }
        
    }

}
