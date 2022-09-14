<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        $event_tickets = $eventId  > 0 ? EventTicket::where(["event_id" => $eventId])->get() : null;


        return view("admin/event/details", [
            "event" => $event,
            "event_tickets" => $event_tickets
        ]);
    }

    function save($eventId = 0, Request $request)
    {
        $event = $eventId  > 0 ? Event::where(["id" => $eventId])->first() : new Event();

        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->entry_type = $request->entry_type;
        $event->venue = $request->venue;
        $event->city = $request->city;
        $event->address = $request->address;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->occurrence = $request->occurrence;
        $event->description = $request->description;

        if ($request->file('cover_image')) {
            $file = $request->file('cover_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $filename);
            $event->cover_image = $filename;
        }
        $event->video_link = $request->video_link;
        $event->event_type = $request->event_type;
        $event->artist = $request->artist;
        $event->abilities = $request->abilities;

        $event->save();
        //save event details
        foreach($request->event_tickets as $ticket){
            

            if($ticket["name"] == "" && $ticket["price"]==""){
                if($ticket["id"] > 0){
                    EventTicket::find($ticket["id"])->delete();
                }
                continue;
            }
            //continue;
            $event_ticket = $ticket["id"] > 0? EventTicket::find($ticket["id"]) : new EventTicket();
            $event_ticket->name = $ticket["name"]??"jfghkcjhjk";
            $event_ticket->price = $ticket["price"];
            $event_ticket->description = $ticket["description"];
            $event_ticket->persons = $ticket["persons"];
            $event_ticket->event_id = $event->id;
            $event_ticket->save();
        }
        return redirect('/admin/event/form/'.$event->id);
    }
    function delete($eventId)
    {
        $event = Event::find($eventId);
        if ($event->delete($eventId)) {
            return redirect('/admin/event');
        }
        return redirect('/admin/event');
    }

    public function dashboard($event_id){
        $event = Event::where("id",$event_id)->first();

        $orders = Order::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as orders'),
            DB::raw('sum(total_price) as amount')
        ])->where("status","SUCCESS")->groupBy(DB::raw('DATE(created_at)'))->get();

        $revenue = 0;
        $total_orders = 0;
        $total_ticket_sold = 0;
        
        $tickets_sold_chart = [
            "data"=>[],
            "labels"=>[],
            "total"=>0
        ];

        $tickets_sales_volume_chart = [
            "data"=>[],
            "labels"=>[],
            "total"=>0
        ];
        foreach($orders as $order){
            $tickets_sold_chart["data"][] = $order->orders;
            $tickets_sales_volume_chart["data"][] = $order->amount;

            $tickets_sold_chart["labels"][] = $order->date;
            $tickets_sales_volume_chart["labels"][] = $order->date;

            $tickets_sold_chart["total"] += $order->orders;
            $tickets_sales_volume_chart["total"] += $order->amount;

            $revenue +=$order->amount;
            $total_orders +=$order->orders;
        }


        return view("admin.event.show", compact(
            "event", "orders",
            'revenue', 'total_orders', 'total_ticket_sold', "tickets_sales_volume_chart", "tickets_sold_chart"
        ));
    }
}
