@extends('admin.layouts.admin')
@section('subnav')
    @include('admin.event.partials.subnav')
@endsection
@section('content')
    <div>
        <h4>Orders</h4>
        <p class="text-muted">Manage your order here.</p>
        <div class="mt-2">
            @include('admin.layouts.partials.messages')
        </div>


        <div class="mt-4">
            <form>
                <div class="row">
                    <input type="hidden" name="page" value="{{ app('request')->input('page') }}" />
                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            <input class="form-control" placeholder="Search order" name="keyword"
                                value="{{ app('request')->input('keyword') }}" />
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" placeholder="Booking Date" name="date"
                                value="{{ app('request')->input('date') }}" />
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">ID</span>
                            <input class="form-control" placeholder="Order ID" name="id"
                                value="{{ app('request')->input('id') }}" />
                        </div>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="status">
                            <option value="">--STATUS--</option>
                            <option {{ app('request')->input('status') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                            <option {{ app('request')->input('status') == 'SUCCESS' ? 'selected' : '' }}>SUCCESS</option>
                            <option {{ app('request')->input('status') == 'FAILED' ? 'selected' : '' }}>FAILED</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="overflow-auto">
            <table class="table table-bordered table-striped mt-4 bg-white">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">ID</th>

                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th class="text-end">Amount</th>
                        <th>Promoter</th>
                        <th class="text-end">Commission</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>In</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr class="data-row" data-row-id="{{ $order->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td><a href="javascript:void()"
                                    onclick="openCheckInDetails('{{ $order->id }}')">{{ $order->id }}</a></td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->mobile }}</td>
                            <td>{{ $order->email }}</td>
                            <td class="text-end">
                                @money($order->total_price)
                            </td>
                            <td>{{ $order->promoter ?? '----' }}</td>
                            <td class="text-end">
                                @money($order->promoter_commission ? $order->promoter_commission : 0) @ {{ $order->promoter_commission_percentage ?? 0 }}%
                            </td>
                            <td>{{ $order->date ? date('d/m/Y', strtotime($order->date)) : '' }}</td>
                            <td><span class="badge bg-{{ $colors[$order->status] }}">{{ $order->status }}</span></td>
                            <td>{{ $order->created_at ? date('d/m/Y h:m A', strtotime($order->created_at)) : '' }}</td>
                            <td class="checked-in">
                                <span
                                    class="badge bg-{{ $order->is_checked_in ? 'success' : 'danger' }}">{{ $order->is_checked_in ? 'Yes' : 'No' }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex mt-4">
            @include('admin.common.pagination', ['paginator' => $orders])
        </div>

        <div class="modal fade" tabindex="-1" id="details-modal">
            <div class="modal-dialog">

            </div>
        </div>

        <script>
            $(document).ready(() => {
                window.checkInModal = new bootstrap.Modal(document.getElementById('details-modal'), {});
            })

            function openCheckInDetails(order_id) {
                jQuery.ajax({
                    url: "{{ url('/admin/event/' . $event->id . '/orders/details') }}",
                    method: 'post',
                    data: {
                        order_id: order_id
                    },
                    success: function(result) {
                        $("#details-modal .modal-dialog").html(result.html);
                        checkInModal.show();
                    }
                });
            }

            function sendEmail(order_id) {
                jQuery.ajax({
                    url: "{{ url('/admin/event/' . $event->id . '/orders/email') }}",
                    method: 'post',
                    data: {
                        order_id: order_id
                    },
                    success: function(result) {
                        alert(result.message);
                    }
                });
            }
        </script>
    </div>
@endsection
