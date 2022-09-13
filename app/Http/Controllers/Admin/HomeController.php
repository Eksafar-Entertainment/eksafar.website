<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as orders'),
            DB::raw('sum(total_price) as amount')
        ])->groupBy(DB::raw('DATE(created_at)'))->get();
        $data = [];
        $amounts = [];
        $labels = [];
        $backgroundColors = [];
        foreach($orders as $order){
            $data[] = $order->orders;
            $amounts[] = $order->amount;
            $labels[] = $order->date;
            $backgroundColors[] = "#dead1b";
        }
        return view('admin.home', compact("data", "amounts" ,"labels", "backgroundColors"));
    }
}
