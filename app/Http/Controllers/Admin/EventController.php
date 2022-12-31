<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FormBuilder;
use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventAlbumImage;
use App\Models\EventTicket;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Venue;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;

class EventController extends Controller
{
    function index()
    {
        $events =  Event::paginate(20);
        $event_ids = array_map(function ($event) {
            return $event["id"];
        }, $events->toArray()["data"]);

        $sales = OrderDetail::select([
            "orders.event_id as id",
            DB::raw("SUM(order_details.quantity) as quantity"),
            DB::raw("SUM(order_details.price) as revenue"),
        ])
            ->join("orders", function ($join) {
                $join->on("orders.id", "=", "order_details.order_id");
            })
            ->groupBy("orders.event_id")
            ->whereIn("orders.event_id", $event_ids)
            ->where("orders.status", "SUCCESS")
            ->get()->toArray();
          
        $sales = array_reduce($sales, function ($all, $current) {
            $all[$current["id"]] = $current;
            return $all;
        }, []);
        return view("admin/event/listing", ["events" => $events, "sales" => $sales]);
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

    function create(Request $request)
    {
        $event = new Event();

        $event->name = $request->name;
        $event->slug = $event->slug == null || $event->slug == "" ? Str::slug($request->name) : $event->slug;
        $event->entry_type = $request->entry_type ?? "";
        $event->venue = $request->venue ?? 0;
        $event->city = $request->city ?? "";
        $event->address = $request->address ?? "";
        $event->start_date = $request->start_date ?? "2020-01-01";
        $event->end_date = $request->end_date ?? "2020-01-01";
        $event->occurrence = $request->occurrence ?? "";
        $event->description = $request->description;
        $event->video_link = $request->video_link ?? "";
        $event->event_type = $request->event_type ?? "";
        $event->artists = $request->artist ?? [];
        $event->abilities = $request->abilities ?? "";
        $event->cover_image = $request->cover_image ?? "";
        $event->terms = $request->terms ?? "";
        $event->min_age = $request->min_age ?? 18;
        $event->language = $request->language ?? "";
        $event->status = $request->status ?? "CREATED";


        $event->save();
        return redirect('/admin/event/' . $event->id . '/customize/');
    }
    function delete($eventId)
    {
        $event = Event::find($eventId);
        if ($event->delete($eventId)) {
            return redirect('/admin/event');
        }
        return redirect('/admin/event');
    }

    public function dashboard($event_id)
    {
        $event = Event::where("id", $event_id)->first();
        $event_tickets = EventTicket::where("event_id", $event_id)->get();
        $event_views = AccessLog::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count'),
        ])
            ->where("uri", "/event/" . $event->slug)
            ->groupBy(DB::raw('DATE(created_at)'))->get();

        $orders = Order::select([
            DB::raw("GROUP_CONCAT(id) as ids"),
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as orders'),
            DB::raw('sum(total_price) as amount'),
            DB::raw('sum(discount) as discount')
        ])
            ->where("status", "SUCCESS")
            ->where("event_id", $event_id)
            ->groupBy(DB::raw('DATE(created_at)'))->get();



        $order_ids = array_reduce($orders->all(), function ($ids, $order) {
            return array_merge($ids, explode(",", $order->ids));
        }, []);

        $order_details = OrderDetail::select([
            "event_ticket_id",
            DB::raw('DATE(created_at) as date'),
            DB::raw('sum(quantity) as orders'),
            DB::raw('sum(price) as amount')
        ])
            ->groupBy("event_ticket_id")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->whereIn("order_id", $order_ids)
            ->get();

        $revenue = 0;
        $views = 0;
        $total_orders = 0;
        $total_ticket_sold = 0;

        $tickets_sold_chart = [
            "data" => [],
            "labels" => [],
            "total" => 0
        ];
        $tickets_sales_volume_chart = [
            "data" => [],
            "labels" => [],
            "total" => 0
        ];

        $event_views_chart = [
            "data" => [],
            "labels" => [],
            "total" => 0
        ];

        $tickets_sold_details_chart = [
            "labels" => [],
            "datasets" => []
        ];
        function rand_color()
        {
            return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }
        $colors = ["#FF4081", "#00C853", "#00BCD4", "#ff5722", "#6200ea", "#aa00ff", "#3e2723"];
        foreach ($event_tickets as $i => $event_ticket) {
            $color = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $tickets_sold_details_chart["datasets"][$event_ticket->id] = [
                "data" => [],
                "label" => $event_ticket->name,
                "fill" => false,
                "borderColor" => $color,
                "backgroundColor" => $color,
                "tension" => 0,
                "pointStyle" => 'circle',
                "pointRadius" => 5,
                "pointBorderColor" => $color
            ];
        }


        $period = CarbonPeriod::create(Carbon::parse($event->created_at)->format("Y-m-d"), date("Y-m-d"));
        foreach ($period as $date) {
            $key = $date->format("Y-m-d");
            $tickets_sold_chart["data"][$key] = 0;
            $tickets_sales_volume_chart["data"][$key] = 0;
            $event_views_chart["data"][$key] = 0;

            $tickets_sold_chart["labels"][$key] = $date->format("d M,y");;
            $tickets_sales_volume_chart["labels"][$key] = $date->format("d M,y");
            $event_views_chart["labels"][$key] = $date->format("d M,y");

            //details chart
            $tickets_sold_details_chart["labels"][$key] = $date->format("d M,y");;
            foreach ($tickets_sold_details_chart["datasets"] as $k => $tickets_sold_details_chart_row) {
                $tickets_sold_details_chart["datasets"][$k]["data"][$key] = 0;
            }
        }
        foreach ($orders as $order) {
            $tickets_sold_chart["data"][$order->date] = $order->orders;

            $tickets_sales_volume_chart["data"][$order->date] = ($order->amount - ($order->discount ?? 0));

            $tickets_sold_chart["total"] += $order->orders;
            $tickets_sales_volume_chart["total"] += ($order->amount - ($order->discount ?? 0));
            $revenue += $order->amount - $order->discount;
            $total_orders += $order->orders;
        }

        foreach ($event_views as $event_view) {
            $event_views_chart["data"][$event_view->date] = $event_view->count;
            $event_views_chart["total"] += $event_view->count;
            $views += $event_view->count;
        }

        foreach ($order_details as $order_detail) {
            $tickets_sold_details_chart["datasets"][$order_detail->event_ticket_id]["data"][$order_detail->date] = $order_detail->orders;
            $total_ticket_sold += $order_detail->orders;
        }



        $tickets_sold_chart["data"] = array_values($tickets_sold_chart["data"]);
        $tickets_sold_chart["labels"] = array_values($tickets_sold_chart["labels"]);

        $tickets_sales_volume_chart["data"] = array_values($tickets_sales_volume_chart["data"]);
        $tickets_sales_volume_chart["labels"] = array_values($tickets_sales_volume_chart["labels"]);

        $event_views_chart["data"] = array_values($event_views_chart["data"]);
        $event_views_chart["labels"] = array_values($event_views_chart["labels"]);

        foreach ($tickets_sold_details_chart["datasets"] as $k => $tickets_sold_details_chart_row) {
            $tickets_sold_details_chart["datasets"][$k]["data"] = array_values($tickets_sold_details_chart["datasets"][$k]["data"]);
        }
        $tickets_sold_details_chart["labels"] = array_values($tickets_sold_details_chart["labels"]);
        $tickets_sold_details_chart["datasets"] = array_values($tickets_sold_details_chart["datasets"]);



        return view("admin.event.manage.dashboard", compact(
            "event",
            "orders",
            'revenue',
            'total_orders',
            'total_ticket_sold',
            "tickets_sales_volume_chart",
            "tickets_sold_chart",
            "tickets_sold_details_chart",
            "views",
            "event_views_chart"
        ));
    }

    //order related
    public function orders($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();

        $colors = [
            "SUCCESS" => "success",
            "PENDING" => "warning",
            "FAILED" => "danger",
            "CANCELLED" => "info"
        ];

        $orders = Order::leftJoin('promoters', function ($join) {
            $join->on('promoters.id', '=', 'orders.promoter_id');
        })->where("orders.event_id", $event_id);

        if (isset($request->query()["id"]) && $request->query()["id"] != "") {
            $orders->where("orders.id", $request->query()["id"]);
        }

        if (isset($request->query()["date"]) && $request->query()["date"] != "") {
            $orders->where("orders.date", $request->query()["date"]);
        }

        if (isset($request->query()["status"]) && $request->query()["status"] != "") {
            $orders->where("orders.status", $request->query()["status"]);
        }

        if (isset($request->query()["keyword"]) && $request->query()["keyword"] != "") {
            $orders->where(function ($query) {
                global $request;
                $query->orWhere("orders.name", "like", "%{$request->query()["keyword"]}%");
            });
        }
        $orders = $orders
            //->groupBy('orders.id')
            ->select(
                "orders.*",
                "promoters.name as promoter",
                DB::raw("(orders.total_price * (promoters.commission/100)) as promoter_commission"),
                "promoters.commission as promoter_commission_percentage"
            )
            ->latest()
            ->paginate(30)->appends($request->query());
        return view("admin.event.manage.orders.index", compact('event', 'orders', "colors"));
    }

    public function orderDetails($event_id, Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::where("id", $order_id)->first();
        $order_details = OrderDetail::where(["order_id" => $order->id])
            ->leftJoin("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
            //->groupBy("order_details.id")
            ->select(
                "order_details.*",
                "event_tickets.name as event_ticket_name",
                "event_tickets.persons as event_ticket_persons"
            )
            ->get();
        return response()->json([
            "status" => 200,
            'message' => 'Successfully fetched data',
            'html' => view("admin.event.manage.orders.details", [
                'order' => $order,
                'order_details' => $order_details
            ])->render()
        ]);
    }

    public function resendMail($event_id, Request $request){
        $order_id = $request->order_id;
        $order = Order::where("id", $order_id)->first();
        if(!$order ||  $order->status != "SUCCESS"){
            return response()->json([
                "status" => 500,
                'message' => 'Invalid order',
            ], 500);
        }
        Mail::to($order->email)->send(new TicketMail($order->id));
        return response()->json([
            "status" => 200,
            'message' => 'Email send successful',
        ]);
    }

    //Ticket related things
    public function tickets($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();
        $where = [];
        $event_tickets = EventTicket::select([
            "event_tickets.*",
            //DB::raw('SUM(IF(orders.status="SUCCESS",order_details.price,0)) as total_sale_amount'),
            DB::raw('SUM(IF(orders.status="SUCCESS",order_details.quantity,0)) as total_sale_count'),
        ])
            ->where("event_tickets.event_id", $event_id)
            ->leftJoin('order_details', function ($join) {
                $join->on('order_details.event_ticket_id', '=', 'event_tickets.id');
            })
            ->leftJoin("orders", function ($join) {
                $join->on('order_details.order_id', '=', 'orders.id');
            })
            ->groupBy("event_tickets.id");
        if (isset($request->query()["keyword"]) && $request->query()["keyword"] != "") {
            $event_tickets->where(function ($query) {
                global $request;
                $query->orWhere("event_tickets.name", "like", "%{$request->query()["keyword"]}%");
                $query->orWhere("event_tickets.description", "like", "%{$request->query()["keyword"]}%");
            });
        }

        $event_tickets = $event_tickets->latest()->get();

        $status_colors = [
            "ACTIVE" => "success",
            "CREATED" => "warning",
            "SOLD" => "danger",
        ];
        return view("admin.event.manage.tickets.index", compact('event', 'event_tickets', "status_colors"));
    }

    public function getTicketForm($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();

        $event_ticket = EventTicket::where("id", $request->event_ticket_id)->first() ?? new EventTicket();
        return response()->json([
            "status" => 200,
            'message' => 'Successfully fetched data',
            'html' => view("admin.event.manage.tickets.form", [
                'event_ticket' => $event_ticket,
                'event' => $event,
            ])->render()
        ]);
    }
    public function saveTicket($event_id, Request $request)
    {
        $event_ticket = EventTicket::where("id", $request->event_ticket_id)->first() ?? new EventTicket();
        $event_ticket->event_id = $event_id;
        $event_ticket->name = $request->name;
        $event_ticket->persons = $request->persons;
        $event_ticket->price = $request->price;
        $event_ticket->description = $request->description;
        $event_ticket->start_datetime = $request->start_datetime;
        $event_ticket->end_datetime = $request->end_datetime;
        $event_ticket->status = $request->status ?? "CREATED";
        $event_ticket->save();
        return response()->json([
            "status" => 200,
            'message' => 'Successfully updated ticket',
        ]);
    }
    //customize
    public function customize($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();
        $event_album_images = EventAlbumImage::where("event_id", $event_id)->get();
        $venues = Venue::get()->toArray();
        $venues = array_map(function ($venue) {
            return [
                "label" => $venue["name"],
                "value" => $venue["id"],
                "avater" => url($venue["logo"]),
            ];
        }, $venues);

        $artists = Artist::get()->toArray();
        $artists = array_map(function ($artist) {
            return [
                "label" => $artist["name"],
                "value" => $artist["id"],
                "avater" => url($artist["image"]),
            ];
        }, $artists);
        return view("admin.event.manage.customize.index", compact('event', "event_album_images", "venues", "artists"));
    }

    function saveEvent($eventId = 0, Request $request)
    {
        $event = $eventId  > 0 ? Event::where(["id" => $eventId])->first() : new Event();

        $event->name = $request->name;
        $event->slug = $event->slug == null || $event->slug == "" ? Str::slug($request->name) : $event->slug;
        $event->entry_type = $request->entry_type;
        $event->venue = $request->venue;
        $event->city = $request->city;
        $event->address = $request->address;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->occurrence = $request->occurrence;
        $event->description = $request->description;
        $event->cover_image = $request->cover_image;
        $event->video_link = $request->video_link;
        $event->event_type = $request->event_type;
        $event->artists = $request->artists;
        $event->min_age = $request->min_age;
        $event->terms = $request->terms;
        $event->language = $request->language;
        $event->abilities = $request->abilities;

        $event->save();
        return redirect('/admin/event/' . $event->id . '/customize/');
    }

    //checkIn
    public function checkInView($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();
        $period = CarbonPeriod::create(Carbon::parse($event->start_date)->format("Y-m-d"), Carbon::parse($event->end_date)->format("Y-m-d"));
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format("Y-m-d");
        }
        return view("admin.event.manage.check-in.index", [
            "event" => $event,
            "dates" => $dates
        ]);
    }
    public function checkInDetails($event_id, Request $request)
    {
        $order_id = $request->order_id;
        $date = $request->date;
        $order = Order::where("id", $order_id)->where("status", "SUCCESS")->first();
        if (!$order) {
            return response()->json([
                "status" => 404,
                'message' => 'No order details found',
            ], 404);
        }
        $order_details = OrderDetail::where(["order_id" => $order->id])
            ->join("event_tickets", 'event_tickets.id', '=', 'order_details.event_ticket_id')
            //->groupBy("order_details.id")
            ->where(DB::raw("DATE(event_tickets.start_datetime)"), $date)
            ->select(
                "order_details.*",
                "event_tickets.name as event_ticket_name",
                "event_tickets.persons as event_ticket_persons"
            )->get();

        if (!(count($order_details) > 0)) {
            return response()->json([
                "status" => 404,
                'message' => 'Tickets not found',
            ], 404);
        }
        
        return response()->json([
            "status" => 200,
            'message' => 'Successfully fetched data',
            'html' => view("admin.event.manage.check-in.details", [
                'order' => $order,
                'order_details' => $order_details
            ])->render()
        ]);
    }

    public function checkIn($event_id, Request $request)
    {
        $order_id = $request->order_id;
        $order = Order::where("id", $order_id)->first();
        $order->is_checked_in = true;
        $order->save();
        return response()->json([
            "status" => 200,
            'message' => 'Data updated successful',
        ]);
    }

    ///album functions
    public function addAlbumImage($event_id, Request $request)
    {
        $event_album_image = new EventAlbumImage();
        $event_album_image->event_id = $event_id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $filename);
            $event_album_image->image = $filename;
        } else {
            abort(400, "Error while uploading image");
        }
        $event_album_image->save();
        return redirect('/admin/event/' . $event_id . '/customize/#album');
    }

    public function deleteAlbumImage($event_id, Request $request)
    {
        $event_album_image = EventAlbumImage::where("id", $request->event_album_image_id)->first();
        $event_album_image->delete();
        return redirect('/admin/event/' . $event_id . '/customize/#album');
    }

    public function status($event_id, Request $request)
    {
        $event = Event::where("id", $event_id)->first();
        if ($request->status == "false") {
            $event->status = "CLOSED";
        } else {
            $event->status = "CREATED";
        }
        $event->save();
        return response()->json([
            "status" => 200,
            'message' => 'Event updated successfully',
        ]);
    }
}
