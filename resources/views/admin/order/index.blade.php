@extends('admin.layouts.admin')

@section('content')


<div class="rounded">
    <h3>Orders</h3>
    <p class="text-muted">Manage your order here.</p>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="1%">#</th>
                <th width="1%">ID</th>

                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Amount</th>
                <th>Promoter</th>
                <th>Commission</th>
                <th>Status</th>
                <th>Checked In</th>
                <th width="3%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->mobile }}</td>
                <td>{{ $order->email }}</td>
                <td>₹{{ $order->total_price }}</td>
                <td>{{ $order->promoter }}</td>
                <td>₹{{ $order->promoter_commission }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->is_checked_in?"Yes": "No" }}</td>

                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $orders->links() !!}
    </div>

</div>
@endsection