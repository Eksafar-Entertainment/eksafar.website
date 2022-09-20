
<div class="card">
    <div class="card-header">
        <h5>Order Details</h5>
    </div>
    <div class="card-body">
        <div class="rounded">
            <div class="mt-4">
                <div class="row">
                    <div class="col-auto">
                        {!! QrCode::size(70)->backgroundColor(255,255,255)->generate($order->id) !!}
                    </div>
                    <div class="col">
                        <div>
                            ID: #{{ $order->id }}
                        </div>
                        <div>
                            Name: {{ $order->name }}
                        </div>
                        <div>
                            Checked In: <span class="text-{{$order->is_checked_in?'success':'danger'}}">{{$order->is_checked_in?"Yes":"No"}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h4>Tickets</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th>Item</th>
                        <th width="1%">Quantity</th>
                        <th width="1%">Persons</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_persons = 0
                    @endphp
                    @foreach($order_details as $key=>$order_detail)
                    @php
                    $total_persons += $order_detail->event_ticket_persons * $order_detail->quantity
                    @endphp
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$order_detail->event_ticket_name}}</td>
                        <td>{{$order_detail->quantity}}</td>
                        <td>{{$order_detail->event_ticket_persons * $order_detail->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <div class="card-footer">
        @if($order->status == "SUCCESS" && !$order->is_checked_in)
        <button type="button" class="btn btn-primary" onclick="checkIn('{{$order->id}}')">Check In</button>
        @endif
    </div>
</div>