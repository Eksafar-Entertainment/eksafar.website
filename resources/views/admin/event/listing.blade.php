@extends('admin.layouts.admin')
@section('content')
<div class="container py-2">
    <div class="card">
        <div class="card-header d-flex">
            <h4 class="header-title flex-grow-1">{{__('Events')}}</h4>
            <div class="">
                <a href="{{url('admin/event/form')}}" class="btn btn-sm btn-primary">New Event</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Entry type</th>
                            <th scope="col">Venue</th>
                            <th scope="col">City</th>
                            <th scope="col">Address</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Occurrence</th>
                            <th scope="col"></th>
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
                                <a type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure')){window.location.href=`{{url('admin/event/delete/'.$event->id)}}`}">Delete</a>
                                <a type="button" class="btn btn-sm btn-primary" href="{{url('/admin/event/form/'.$event->id)}}">Edit</a>
                                <a class="btn btn-sm btn-deafult" href="{{url('/admin/event/'.$event->id."/dashboard")}}">Manage</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-2 text-end">
        @include('admin.common.pagination', ['paginator' => $events])
    </div>
</div>
@endsection