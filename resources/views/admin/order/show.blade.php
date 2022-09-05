@extends('admin.layouts.admin')

@section('content')
    <div class="rounded">
        <h3>Order Details</h3>
        <div class="mt-4">
            <div>
                Title: {{ $order->title }}
            </div>
            <div>
                Description: {{ $order->description }}
            </div>
            <div>
                Body: {{ $order->body }}
            </div>
        </div>

    </div>
    <div>
        <a href="{{ route('order.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection