<html>

<head>
    <style>
        * {
            color: #222;
        }

        html,
        body {
            color: #222;
        }

        .main {
            max-width: 450px;
            margin: auto;
            padding: 15px;

        }

        header {
            text-align: center;
        }

        header .logo {
            color: #031364
        }

        .container {
            background-color: white;
            margin-bottom: 10px;
        }

        .p-3 {
            padding: 20px
        }

        .order-details-table {
            border-collapse: collapse;
            width: 100%
        }

        .order-details-table tr {
            border-bottom: 1px solid #fafafa
        }

        .order-details-table tr th,
        .order-details-table tr td {
            padding: 8px 10px;
            text-align: left
        }
    </style>
</head>

<body>
    <div style="background-color: #f5f5f5;">
        <div class="main">
            <header>
                <h3 class="logo">EKSAFAR</h3>

            </header>

            <p>
                Hey {{ $order->name }},<br />
                This is just a confirmation email regarding you order
            </p>

            <div class="container">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px dashed #000000">
                        <td style="text-align: center; letter-spacing: 1.5; padding: 20px">
                            <img src="{{ route('resources:images:qr', ['content' => $order->uid]) }}"
                                style="width: 120px"><br>
                            #{{ $order->uid }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px">
                            <p color="#555"><small>{{ $event->event_type }}</small></p>
                            <h2 style="margin:5px 0">{{ $event->name }}</h2>
                            <p>{{ $venue->name }}, {{ $venue->address }}</p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="container p-3">
                <h3>Summery</h3>
                <div class="table">
                    <table class="order-details-table">
                        <tr>
                            <th style="padding-left: 0">Item</th>
                            <th>Qtde.</th>
                            <th style="padding-right: 0; text-align: right">Price</th>
                        </tr>
                        @foreach ($order_details as $order_detail)
                            <tr>
                                <td style="padding-left: 0">
                                    {{ $order_detail->event_ticket_name }}<br>
                                    <small
                                        style="color: green">{{ \Carbon\Carbon::parse($order_detail->event_ticket_start_datetime)->format('d M Y h:m A') }}</small>
                                </td>
                                <td width="1%">{{ $order_detail->quantity }}</td>
                                <td style="padding-right: 0; text-align: right">@money($order_detail->price)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="padding-left: 0" colspan="2">Total</td>
                            <td style="padding-right: 0; text-align: right">@money($order->total_price)</td>
                        </tr>
                        @if ($order->discount > 0)
                            <tr>
                                <td style="padding-left: 0" colspan="2">Discount</td>
                                <td style="padding-right: 0; text-align: right">@money($order->discount)</td>
                            </tr>

                            <tr>
                                <td style="padding-left: 0" colspan="2">Grand Total</td>
                                <td style="padding-right: 0; text-align: right">@money($order->total_price - $order->discount)</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="container p-3">
                <h3>Terms & Conditions</h3>
                {!! $event->terms !!}

            </div>


            <footer>
                <p>
                    Thanks,<br>
                    {{ config('app.name') }}
                </p>
            </footer>
        </div>
    </div>
</body>

</html>
