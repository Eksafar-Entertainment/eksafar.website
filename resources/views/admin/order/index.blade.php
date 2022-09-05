@extends('admin.layouts.admin')

@section('content')


<div class="rounded">
    <h3>Posts</h3>
    <p class="text-muted">Manage your order here.</p>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="1%">No</th>
                <th>Name</th>
                <th width="3%" colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->title }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('order.edit', $order->id) }}">Edit</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['order.destroy', $order->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
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