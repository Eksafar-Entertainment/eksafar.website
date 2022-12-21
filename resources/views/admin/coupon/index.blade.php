@extends('admin.layouts.admin')

@section('content')


<div class="bg-light p-4 rounded">
    <h2>Artist</h2>
    <div class="lead">
        Manage your Artist here.
        <a href="{{ route('coupon.create') }}" class="btn btn-primary btn-sm float-right">Add coupon</a>
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">No</th>
            <th>Code</th>
            <th>Discount</th>
            <th>Type</th>
            <th>Remaining</th>
            <th>Actions</th>
        </tr>
        @foreach ($coupons as $key => $coupon)
        <tr>
            <td>{{ $coupon->id }}</td>
            <td>{{ $coupon->code }}</td>
            <td>{{ $coupon->discount }}</td>
            <td>{{ $coupon->type }}</td>
            <td>{{ $coupon->remaining_count }}</td>
            {{-- <td>
                <a class="btn btn-info btn-sm" href="{{ route('coupon.show', $coupon->id) }}">Show</a>
            </td> --}}
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('coupon.edit', $coupon->id) }}">Edit</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route' => ['coupon.destroy', $coupon->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex">
        {!! $coupons->links() !!}
    </div>

</div>
@endsection


