@extends('admin.layouts.admin')

@section('content')
<div class="container py-2">
    <div class="card">
        <div class="card-header d-flex">
            <h4 class="header-title flex-grow-1">{{__('Orders')}}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Email</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index=>$order)
                        <tr>
                            <td>{{(($orders->currentPage() - 1)* $orders->perPage()) +  $index + 1 }}</td>
                            <td>
                                <a href="{{url('/admin/order/'.$order->id)}}">{{$order->id}}</a>
                            </td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->mobile}}</td>
                            <td>{{$order->email}}</td>
                            <td>₹{{$order->total_price}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-2 text-end">
        @include('admin.common.pagination', ['paginator' => $orders])
    </div>
</div>
@endsection