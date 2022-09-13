<html>

<head>
    <style>
        *{
            color: #222;
        }
        body {
            color: #222;
            background-color: white;
        }

        .order-details-table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #e5e5e5;
            ;
        }

        .order-details-table tr {
            border-bottom: 1px solid #e5e5e5;
        }

        .order-details-table th {
            background-color: #f1f1f1;
        }

        .order-details-table th,
        .order-details-table td {
            text-align: left;
            padding: 5px 5px;
            border: 1px solid #e5e5e5;
            ;
        }
        p{
            color: #222222
        }
    </style>
</head>

<body>
    <header style="background-color: #f1f1f1; text-align:center; font-size: 25px; color:#031364; padding: 25px">
        <strong>Eksafar Club</strong>
    </header>
    <p>
        Hey {{$order->name}},<br />
        This is just a confirmation email regarding you order
    </p>

    <h2>Event Ticket</h2>
    <table style="background-color: rgb(248, 242, 231); width: 100%; border-collapse: collapse; border: 1px dotted #ccc;">
        <tr>
            <td style="background-color: #031364; writing-mode: vertical-rl;
            text-orientation: mixed; text-align: center; letter-spacing: 1.2px; color: white;">
                #{{$order->id}}
            </td>
            <th style="border-right: 1px dotted #ccc; padding: 10px;">
                <strong style="font-size: 25px;">{{ \Carbon\Carbon::parse($order->date)->format('d')}}</strong><br />
                <span style="font-weight: 400;">{{ \Carbon\Carbon::parse($order->date)->format('M')}}</span>
            </th>
            <td style="padding: 10px;">
                <span color="#555">Dandia Festival</span>
                <h2 style="margin:5px 0">Disco Dandia Night</h2>
                <table style="border-collapse: collapse; font-size: 10px; color: #555;">
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y')}}</td>
                    </tr>
                    <tr>
                        <td>Catch Up, 17th Cross Road, 6th Sector, <br />HSR Layout, Bengaluru, Karnataka 560102</td>
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
        <table class="order-details-table">
            <tr>
                <th>Item</th>
                <th>Person</th>
                <th>Price</th>
            </tr>
            @foreach($order_details as $order_detail)
            <tr>
                <td>{{$order_detail->event_ticket_name}} x {{$order_detail->quantity}}</td>
                <td>₹{{$order_detail->price}}</td>
            </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td>₹{{$order->total_price}}</td>
            </tr>
        </table>

    </div>


    <p>
        Thanks,<br>
        {{ config('app.name') }}
    </p>
</body>

</html>