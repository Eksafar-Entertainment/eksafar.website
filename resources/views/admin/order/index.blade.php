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
            <tr class="data-row" data-row-id="{{$order->id}}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->mobile }}</td>
                <td>{{ $order->email }}</td>
                <td>₹{{ $order->total_price }}</td>
                <td>{{ $order->promoter }}</td>
                <td>₹{{ $order->promoter_commission }}</td>
                <td><span class="badge bg-{{$colors[$order->status]}}">{{ $order->status }}</span></td>
                <td class="checked-in"><span class="text-{{ $order->is_checked_in?'success': 'danger' }}">{{ $order->is_checked_in?"Yes": "No" }}</span></td>

                <td>
                    <!--<a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}">Show</a>-->
                    <a class="btn btn-info btn-sm" onclick="openCheckInDetails('{{$order->id}}')">Show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $orders->links() !!}
    </div>


    <div class="modal fade" tabindex="-1" id="details-modal">
        <div class="modal-dialog">

        </div>
    </div>

    <script>
        var checkInDetailsModal = new bootstrap.Modal(document.getElementById('details-modal'), {})
        function openCheckInDetails(order_id) {
            jQuery.ajax({
                url: "{{ url('/admin/order/check-in-details') }}",
                method: 'post',
                data: {
                    order_id: order_id
                },
                success: function(result) {
                    $("#details-modal .modal-dialog").html(result.html);
                    checkInDetailsModal.show();
                }
            });
        }

        function checkIn(order_id) {
            jQuery.ajax({
                url: "{{ url('/admin/order/check-in') }}",
                method: 'post',
                data: {
                    order_id: order_id
                },
                success: function(result) {
                    $(`tr.data-row[data-row-id=${order_id}] .checked-in`).html("<span class='text-success'>Yes</span>");
                    checkInDetailsModal.hide();
                }
            });
        }
    </script>

</div>
@endsection