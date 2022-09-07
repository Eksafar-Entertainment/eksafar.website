@component('mail::message')
Hey {{$order->name}},
This is just a confirmation email regarding you order
<div class=order-box>
    <strong style="font-size: 25px;">#{{$order->id}}</strong><br />
</div>
<h2>Order summery</h2>
<div class="table">
@component('mail::table')
| Item                                                               | Amount                       |
| ------------------------------------------------------------------ | ---------------------------: |
@foreach($order_details as $order_detail)
| {{$order_detail->event_ticket_name}} x {{$order_detail->quantity}} | ₹{{$order_detail->price}}    |
@endforeach
| Total                                                              | **₹{{$order->total_price}}** |
@endcomponent
</div>


<style>
    .order-box{
        padding: 10px 25px; 
        text-align: center; 
        background-color:#0000ff10;
        border-radius: 8px;
        border: 1px dashed #00000010;
        margin: 20px 0;
    }
    .table table{
        width: 100%
    }
    .table table th{
        text-align: left;
    }
</style>


Thanks,<br>
{{ config('app.name') }}

@endcomponent