<?php

namespace App\Http\Controllers\Promoter;

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
use App\Models\Location;
use App\Models\Promoter;
use stdClass;

class EventController extends Controller
{
    function index(Request $request)
    {
        $promoters = Promoter::select(["id"])->where("parent_id", auth("promoter")->user()->id)->orWhere("id", auth("promoter")->user()->id)->get();
        $promoter_ids = array_map(function ($promoter) {
            return $promoter["id"];
        }, $promoters->toArray());
        if ($request->query->has("promoter")) {
            $promoter_ids = [$request->query("promoter")];
        }

        $events = Event::select([
            "events.*",
            "venues.name as venue_name",
        ]);

        $events->join('venues', function ($join) {
            $join->on("events.venue", "=", "venues.id");
        });


        $events->join('orders', function ($join) {
            $join->on("orders.event_id", "=", "events.id");
        });


        $events->whereIN("orders.promoter_id",  $promoter_ids);
        $events->where("orders.id", "!=",  $promoter_ids);
        $events->where("orders.status", "=",  "SUCCESS");


        if ($request->query->has("fromDate")  && $request->query("fromDate") != "") {
            $events->where("events.start_date", ">=", Carbon::parse($request->query("fromDate")));
        }

        if ($request->query->has("toDate") && $request->query("toDate") != "") {
            $events->where("events.start_date", "<=", Carbon::parse($request->query("toDate")));
        }
        if ($request->query->has("status") && $request->query("status") != "") {
            $events->where("events.status", "=", $request->query("status"));
        }

        $events->groupBy("events.id");





        $events = $events->paginate(20);





        return view("promoter/event/listing", ["events" => $events]);
    }



    public function dashboard($event_id, Request $request)
    {


        $promoter = $request->query("promoter");
        $promoters = Promoter::select(["id", "name"])->where("parent_id", auth("promoter")->user()->id)->orWhere("id", auth("promoter")->user()->id)->get();
        $promoter_ids = array_map(function ($promoter) {
            return $promoter["id"];
        }, $promoters->toArray());
        if ($promoter) {
            $promoter_ids = [$promoter];
        }

        $event = Event::where("id", $event_id)->first();
        $event_tickets = EventTicket::where("event_id", $event_id)->get();
        $event_views = AccessLog::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        ])->where("uri", "/event/" . $event->slug)
            ->where(function ($query) use ($promoter_ids) {
                foreach ($promoter_ids as $promoters_id) {
                    $query->orWhere("request", "REGEXP", '(.*)"promoter";s:' . strlen($promoters_id) . ':"' . $promoters_id . '"(.*)');
                }
                return $query;
            })
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();




        $orders = Order::select([
            DB::raw("GROUP_CONCAT(id) as ids"),
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as orders'),
            DB::raw('sum(total_price) as amount'),
            DB::raw('sum(discount) as discount')
        ])
            ->where("status", "SUCCESS")
            ->where("event_id", $event_id)
            ->whereIn("orders.promoter_id", $promoter_ids)
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
            $color = "#" . str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
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

        $end_date = date("Y-m-d");
        if(Carbon::now()->greaterThan(Carbon::parse($event->end_date))){
            $end_date = Carbon::parse($event->end_date)->format("Y-m-d");
        }


        $period = CarbonPeriod::create(Carbon::parse($event->created_at)->format("Y-m-d"), $end_date);
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



        return view("promoter.event.manage.dashboard", compact(
            "event",
            "orders",
            'revenue',
            'total_orders',
            'total_ticket_sold',
            "tickets_sales_volume_chart",
            "tickets_sold_chart",
            "tickets_sold_details_chart",
            "views",
            "event_views_chart",
            "promoters"
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
        return view("promoter.event.manage.orders.index", compact('event', 'orders', "colors"));
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
            'html' => view("promoter.event.manage.orders.details", [
                'order' => $order,
                'order_details' => $order_details
            ])->render()
        ]);
    }
}
