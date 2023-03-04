<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Order ({{ $order->uid }})</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="rounded">
            <div class="mt-4">
                <table class="table table-bordered table-striped table-sm">
                    <tr>
                        <td>ID</td>
                        <td>#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Ref. ID</td>
                        <td>{{ $order->uid }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $order->mobile }}</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="mt-4">
            <h5>Order details</h5>
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th width="1%">#</th>
                        <th>Item</th>
                        <th width="1%">Qty.</th>
                        <th class="text-end" width="1%">Rate</th>
                        <th class="text-end" width="1%">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details as $key => $order_detail)
                    <pre>
                    </pre>
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order_detail->event_ticket_name }}</td>
                            <td>{{ $order_detail->quantity }}</td>
                            <td class="text-end">@money($order_detail->rate)</td>
                            <td class="text-end">@money($order_detail->rate * $order_detail->quantity)</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            </th>
                        <th class="text-end">Total</th>
                        <td class="text-end">@money($order->total_price)</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <th class="text-end">Discount</th>
                        <td class="text-end">@money($order->discount)</td>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th class="text-end" nowrap></th>
                        <th class="text-end">@money($order->total_price - $order->discount)</th>
                    </tr>



                </tfoot>

            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
</div>
