<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    function index()
    {
        $events =  Event::paginate(20);
        return view("admin/event/listing", ["events" => $events]);
    }

    function details($eventId = 0)
    {
        $event = Event::where(["id" => $eventId])->first();
        //
        //$form = new FormBuilder("event-form", "");
        //$form->addText("name", "Name", "rgfdhfhfghfghfgh", true);

        //$form->render();




        return view("admin/event/details", ["event" => $event, "eventId"=>$eventId]);
    }

    function save($eventId = 0, Request $request)
    {
        $event = $eventId  > 0? Event::where(["id" => $eventId])->first() : new Event();
        
        $event->name= $request->name;
        $event->entry_type= $request->entry_type;
        $event->venue= $request->venue;
        $event->city= $request->city;
        $event->address= $request->address;
        $event->start_date= $request->start_date;
        $event->end_date= $request->end_date;
        $event->occurrence= $request->occurrence;
        $event->description= $request->description;

        if($request->file('cover_image')){
            $file= $request->file('cover_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $filename);
            $event->cover_image = $filename;
        }
        $event->video_link= $request->video_link;
        $event->event_type= $request->event_type;
        $event->artist= $request->artist;
        $event->abilities= $request->abilities;
        
        if($event->save()){
            return redirect('/admin/event');
        }

        return view("admin/event/details", ["event"=>$event]);
    }
    function delete($eventId){
        $event = Event::find($eventId);
        if($event->delete($eventId)){
            return redirect('/admin/event');
        }
        return redirect('/admin/event');
    }
}
