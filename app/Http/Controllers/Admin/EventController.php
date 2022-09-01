<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    function index(){
        $events =  Event::paginate(20);
        return view("admin/event/listing", ["events"=>$events]);
    }
}
