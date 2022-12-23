@extends('admin.layouts.admin')

@section('content')
    <div>
        <h4>Coupons</h4>
        <div class="d-flex">
            <div class="flex-grow-1">Manage your Artist here.</div>
            <a href="{{ route('coupon.create') }}" class="btn btn-primary btn-sm float-right">Add coupon</a>
        </div>

        <div class="mt-2">
            @include('admin.layouts.partials.messages')
        </div>

        <div class="overflow-auto card rounded mt-4">
            <table class="table table-striped bg-white mb-0">
                <tr>
                    <th width="1%">No</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Type</th>
                    <th>Remaining</th>
                    <th colspan="2">Actions</th>
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
                        <td width="1%">
                            <a class="btn btn-primary btn-sm" href="{{ route('coupon.edit', $coupon->id) }}">Edit</a>
                        </td>
                        <td width="1%">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['coupon.destroy', $coupon->id], 'style' => 'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="d-flex mt-4">
            @include('admin.common.pagination', ['paginator' => $coupons])
        </div>

    </div>
@endsection
