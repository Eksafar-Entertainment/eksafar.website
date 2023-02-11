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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->session()->get("location") ?? 1;
        $gallery = GalleryImage::latest()->limit(6)->get();
        $events = Event::limit(4)
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])->orderBy('start_date', 'DESC')->get();

        $upcoming_events = Event::where('start_date', '>=', Carbon::today())
            //->where("events.location", $location)
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])
            ->orderBy('start_date', 'DESC')->get();

        $past_events = Event::limit(6)
            ->where('start_date', '<', Carbon::today())
            //->where("events.location", $location)
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])
            ->orderBy('start_date', 'DESC')->get();
        $banners = Banner::limit(4)->get();
        $type = '/';
        return view('front.home', compact(
            'gallery',
            'events',
            'upcoming_events',
            'past_events',
            'banners',
            'type'
        ));
    }

    public function route($path)
    {
        $type = '/';

        switch ($path) {
            case "performer": {
                    $type = 'performer';
                    return view('front.performer.index', compact('path', 'type'));
                }

            case "about": {
                    $type = 'about';
                    return view('front.about.index', compact('path', 'type'));
                }

            case "gallery": {
                    $type = 'gallery';
                    $gallery = GalleryImage::latest()->paginate();
                    return view('front.gallery.index', compact('gallery', 'type'));
                }

            case "guest": {
                    $type = 'guest';
                    return view('front.guest.index', compact('path', 'type'));
                }

            case "elements": {
                    $type = 'elements';
                    return view('front.elements.index', compact('path', 'type'));
                }

            case "upcomming": {
                    $type = 'upcomming';
                    return view('front.events.index', compact('path', 'type'));
                }

            case "current": {
                    $type = 'current';
                    return view('front.events.event.index', compact('path', 'type'));
                }

            case "contact": {
                    $type = 'contact';
                    return view('front.contact.index', compact('path', 'type'));
                }

            case "privacy": {
                    $type = 'privacy';
                    return view('front.extra.privacy', compact('path', 'type'));
                }

            case "payment-policy": {
                    $type = 'payment-policy';
                    return view('front.extra.payment-policy', compact('path', 'type'));
                }

            case "terms": {
                    $type = 'terms';
                    return view('front.extra.terms', compact('path', 'type'));
                }

            default:
                return abort(404);
        }
    }

    function contact(Request $request)
    {
        $message = "Name :" . $request->name . PHP_EOL;
        $message .= "Email :" . $request->email . PHP_EOL;
        $message .= "Subject :" . $request->subject . PHP_EOL;
        $message .= "Message :" . $request->message . PHP_EOL;
        Mail::raw($message, function ($message) {
            $message->to("support@eksafar.club")
                ->subject("Enquiry from website");
        });

        $path = "contact";
        $type = 'contact';
        $message = "Successfully enquiry sent.";
        return view('front.contact.index', compact('path', 'type', 'message'));
    }
}
