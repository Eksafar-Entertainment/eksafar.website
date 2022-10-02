<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\EventTicket;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Event;
use App\Models\User;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $gallery = GalleryImage::latest()->get(); 
        $events = Event::limit(4)->get();
        $banners = Banner::limit(4)->get();
        $faker = \Faker\Factory::create();
        return view('welcome', compact('gallery', 'faker', 'events', 'banners'));
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

    public function checkEmail(Request $request)
    {
        
        $user = DB::table('users')->Where('email', 'LIKE', "%{$request->email}%")->first();
        return \Response::json($user);
    }

    public function checkLogin(Request $request)
    {
        
        $user = DB::table('users')->Where('email', 'LIKE', "%{$request->email}%")->first();
        if(\Hash::check(request('password'), $user->password))
        {
            return \Response::json($user);
        }
        {
            return \Response::json('Incorrect passowrd');
        }
    }

}
