@extends('layouts.admin')

@section('content')
<div class="container py-2">
    <div class="card">
        <div class="card-header">Events</div>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Entry type</th>
                <th>Venue</th>
                <th>City</th>
                <th>Address</th>
                <th>Start</th>
                <th>End</th>
                <th>Occurrence</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $index=>$event)
            <tr>
                <td>{{(($events->currentPage() - 1)* $events->perPage()) +  $index + 1 }}</td>
                <td>{{$event->name}}</td>
                <td>{{$event->entry_type}}</td>
                <td>{{$event->venue}}</td>
                <td>{{$event->city}}</td>
                <td>{{$event->address}}</td>
                <td>{{$event->start_date}}</td>
                <td>{{$event->end_data}}</td>
                <td>{{$event->occurrence}}</td>
                <td class="text-end">
                    <a type="button" class="link text-danger">Delete</a>
                    <a type="button" class="link" href="{{url('/admin/event/form/'.$event->id)}}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="mt-2 text-end">
        @include('admin.common.pagination', ['paginator' => $events])
    </div>
</div>
@endsection