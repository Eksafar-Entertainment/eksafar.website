<html>

<head>
    <style>
        * {
            color: #222;
        }

        body {
            color: #222;
        }

        main {
            max-width: 500px;
            margin: auto;
            padding: 25px;
            background-color: #e5e5e5 
        }

        header {
            text-align: center;
        }

        header .logo{
            color: #031364
        }

        .container {
            background-color: white;
            margin-bottom: 10px;
        }
        .p-3{
            padding: 20px
        }
    </style>
</head>

<body>
    <main>
        <header>
            <h3 class="logo">EKSAFAR</h3>
            <h5>
                Hey {{$order->name}},<br />
                This is just a confirmation email regarding you order
            </h5>
        </header>



        <div class="container">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td colspan="2"
                        style="background-color: #031364; text-align: center; letter-spacing: 1.2px; color: white;">
                        <img src="{{url('storage/uploads/qr-'.$order->id.'png')}}">
                        #{{$order->id}}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <p color="#555"><small>{{$event->event_type}}</small></p>
                        <h2 style="margin:5px 0">{{$event->name}}</h2>
                        <p>{{$venue->name}}, {{$venue->address}}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="container p-3">
            <h3>Order summery</h3>
            <div class="table">
                <table class="order-details-table">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                    </tr>
                    @foreach($order_details as $order_detail)
                    <tr>
                        <td>
                            {{$order_detail->event_ticket_name}} x {{$order_detail->quantity}}<br>
                            <small>{{ \Carbon\Carbon::parse($order_detail->event_ticket_start_datetime)->format('d M Y')}}</small>
                        </td>
                        <td>₹{{$order_detail->price}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        <td>₹{{$order->total_price}}</td>
                    </tr>
                </table>

            </div>
        </div>


        <footer>
            <p>
                Thanks,<br>
                {{ config('app.name') }}
            </p>
        </footer>
    </main>
</body>

</html>