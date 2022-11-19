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
        $agent = new Agent();
        $gallery = GalleryImage::latest()->limit(6)->get();
        $events = Event::limit(4)
            ->join('venues', "events.venue", "=", "venues.id")
            ->select(["events.*", "venues.name as venue_name"])->get();
        $banners = Banner::limit(4)->get();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();
        $faker = \Faker\Factory::create();
        $type = '/';

        //generate pdf
        //$image = new \mikehaertl\wkhtmlto\Image('<html>.This is the end</html>');
        ///

        return view('front.home', compact('desktop', 'mobile', 'tablet', 'gallery', 'faker', 'events', 'banners', 'type'));
    }

    public function route($path)
    {
        $agent = new Agent();
        $desktop = $agent->isDesktop();
        $mobile = $agent->isMobile();
        $tablet = $agent->isTablet();
        $type = '/';

        switch ($path) {
            case "performer": {
                    $type = 'performer';
                    return view('front.performer.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "about": {
                    $type = 'about';
                    return view('front.about.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "gallery": {
                    $type = 'gallery';
                    $gallery = GalleryImage::latest()->paginate();
                    return view('front.gallery.index', compact('gallery', 'type'));
                }

            case "guest": {
                    $type = 'guest';
                    return view('front.guest.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "elements": {
                    $type = 'elements';
                    return view('front.elements.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "upcomming": {
                    $type = 'upcomming';
                    return view('front.events.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "current": {
                    $type = 'current';
                    return view('front.events.event.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "contact": {
                    $type = 'contact';
                    return view('front.contact.index', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "privacy": {
                    $type = 'privacy';
                    return view('front.extra.privacy', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "payment-policy": {
                    $type = 'payment-policy';
                    return view('front.extra.payment-policy', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            case "terms": {
                    $type = 'terms';
                    return view('front.extra.terms', compact('desktop', 'mobile', 'tablet', 'path', 'type'));
                }

            default:
                return abort(404);
        }
    }
}
