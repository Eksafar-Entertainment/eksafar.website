@extends('admin.layouts.admin')
@section('content')
<div>

    <div class="d-flex">
        <h4 class="flex-grow-1">{{__('Events')}}</h4>
        <div class="">
            <a href="{{url('admin/event/form')}}" class="btn btn-sm btn-primary">New Event</a>
        </div>
    </div>


    <div class="row mt-4">
        @foreach($events as $index=>$event)
        @php
        $revenue = isset($sales[$event->id])?$sales[$event->id]["revenue"]:0;
        $quantity = isset($sales[$event->id])?$sales[$event->id]["quantity"]:0;
        @endphp
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-light d-flex align-items-center">
                    <div class="bg-white text-primary text-center p-1 border-primary border" style="width: 50px; height: 60px; margin-top: -20px">
                        <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M')}}</small>
                        <span class="fs-5">{{ \Carbon\Carbon::parse($event->start_date)->format('d')}}</span>
                    </div>
                    <div class="flex-grow-1 ps-3">
                        <h5 class="mb-0">{{$event->name}}</h5>
                        <p class="mb-0">At {{$event->venue}}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <span class="fs-5">{{ $quantity }}</span><br />
                            <span class="text-primary">Tickets Sold</span>
                        </div>

                        <div class="col text-center">
                            <span class="fs-5">
                                @money($revenue)
                            </span><br />
                            <span class="text-primary">Revenue</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex">
                    <button class="btn btn-light btn-sm flex-grow-1" onclick="if(confirm('Are you sure')){window.location.href=`{{url('admin/event/delete/'.$event->id)}}`}">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    <a class="btn btn-light btn-sm flex-grow-1" href="{{url('/admin/event/'.$event->id.'/customize')}}">
                        <i class="fas fa-pencil"></i> Customize
                    </a>
                    <a class="btn btn-light btn-sm flex-grow-1" href="{{url('/admin/event/'.$event->id."/dashboard")}}">
                        <i class="fas fa-settings"></i> Manage
                    </a>
                </div>
            </div>

        </div>
        @endforeach

    </div>

    <div class="mt-2 text-end">
        @include('admin.common.pagination', ['paginator' => $events])
    </div>
</div>
@endsection