@extends('admin.layouts.admin')

@section('content')
<div class="rounded">
    <h3>Order Details</h3>
    <div class="mt-4">
        <div>
            ID: #{{ $order->id }}
        </div>
        <div>
            Name: {{ $order->name }}
        </div>
        <div>
            Email: {{ $order->email }}
        </div>
        <div>
            Mobile: {{ $order->mobile }}
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
                <th class="text-end" width="1%">Rate</th>
                <th class="text-end" width="1%">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_details as $key=>$order_detail)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$order_detail->event_ticket_id}}</td>
                <td>{{$order_detail->quantity}}</td>
                <td class="text-end">₹{{$order_detail->price}}</td>
                <td class="text-end">₹{{$order_detail->price}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th class="text-end" colspan="4">
                    ₹{{$order->total_price}}
                </th>
            </tr>

        </tfoot>

    </table>
</div>
<div>
    <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
</div>
@endsection