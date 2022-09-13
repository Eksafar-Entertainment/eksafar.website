@component('mail::message')
Hey {{$order->name}},
This is just a confirmation email regarding you order
<div class=order-box>
    <strong style="font-size: 25px;">#{{$order->id}}</strong><br />
</div>
<h2>Event Ticket</h2>

<table style="background-color: rgb(248, 242, 231); width: 100%; border-collapse: collapse; border: 1px dotted #ccc; border-top-width: 0;">
       
        <tr>
            <td style="background-color: #031364; writing-mode: vertical-rl;
            text-orientation: mixed; text-align: center; letter-spacing: 1.2px; color: white;">
                #{{$order->id}}
            </td>
            <th style="border-right: 1px dotted #ccc; padding: 10px;">
                <strong style="font-size: 25px;">{{ \Carbon\Carbon::parse($order->date)->format('d')}}</strong><br/>
                <span style="font-weight: 400;">{{ \Carbon\Carbon::parse($order->date)->format('M')}}</span>
            </th>
            <td style="padding: 10px;">
                <span color="#555">Dandia Festival</span>
                <h2 style="margin:5px 0">Disco Dandia Night</h2>
                <table style="border-collapse: collapse; font-size: 10px; color: #555;">
                    <tr>
                        <td style="padding-left: 10px;">{{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 10px;">Catch Up, 17th Cross Road, 6th Sector, <br/>HSR Layout, Bengaluru, Karnataka 560102</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background-color: #fafafa;  padding:2px 5px ;">Eksafar Club</td>
        </tr>
    </table>

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