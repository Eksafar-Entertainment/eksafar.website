@extends('admin.layouts.admin')
@section('content')
    <div>

        <div class="d-flex">
            <h4 class="flex-grow-1">{{ __('Events') }}</h4>
            <div class="">
                    <a href="/admin/event/all" class="btn btn-sm btn-primary">Show All Events</a>
                @if (Auth::user()->can('event:create'))
                    <a data-bs-toggle="modal" data-bs-target="#new-event-modal" class="btn btn-sm btn-primary">Create Event</a>
                @endif
            </div>
        </div>


        <div class="row mt-4">
            @foreach ($events as $index => $event)
                @php
                    $revenue = isset($sales[$event->id]) ? $sales[$event->id]['revenue'] : 0;
                    $quantity = isset($sales[$event->id]) ? $sales[$event->id]['quantity'] : 0;
                @endphp
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-light d-flex align-items-center">
                            <div class="bg-white text-primary text-center p-1 border-primary border"
                                style="width: 50px; height: 60px; margin-top: -20px">
                                <small>{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</small>
                                <span class="fs-5">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <h5 class="mb-0">{{ $event->name }}</h5>
                                <p class="mb-0">At {{ $event->venue }}</p>
                            </div>
                            <div>
                                <div class="">
                                    <select class="form-select form-select-sm border-0" inline-edit-table="events" inline-edit-field="status" inline-edit-where="id='{{$event->id}}'">
                                        <option {{$event->status === "CREATED" ? "selected":""}}>CREATED</option>
                                        <option {{$event->status === "CLOSED" ? "selected":""}}>CLOSED</option>
                                    </select>
                                </div>
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
                        <div class="card-footer p-0">
                            <div class="btn-group d-flex" role="group" aria-label="Basic example">
                                @if (Auth::user()->can('event:dashboard'))
                                    <a class="btn btn-light flex-grow-1 text-primary"
                                        href="{{ url('/admin/event/' . $event->id . '/dashboard') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->can('event:tickets'))
                                    <a class="btn btn-light flex-grow-1 text-primary"
                                        href="{{ url('/admin/event/' . $event->id . '/tickets') }}">
                                        <i class="fas fa-ticket"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->can('event:orders'))
                                    <a class="btn btn-light flex-grow-1 text-primary"
                                        href="{{ url('/admin/event/' . $event->id . '/orders') }}">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->can('event:check-in'))
                                    <a class="btn btn-light flex-grow-1 text-primary"
                                        href="{{ url('/admin/event/' . $event->id . '/check-in') }}">
                                        <i class="fa-solid fa-person-booth"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->can('event:delete'))
                                    <a class="btn btn-light flex-grow-1 text-danger"
                                        onclick="ask('Are you sure want to delete the event?').then(e=>window.location.href=`{{ url('admin/event/delete/' . $event->id) }}`).catch(console.log)">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                                @if (Auth::user()->can('event:customize'))
                                    <a class="btn btn-light flex-grow-1 text-success"
                                        href="{{ url('/admin/event/' . $event->id . '/customize') }}">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        <div class="mt-2 text-end">
            @include('admin.common.pagination', ['paginator' => $events])
        </div>
    </div>
    @if (Auth::user()->can('event:create'))
        <div class="modal fade" id="new-event-modal" tabindex="-1">
            <form enctype="multipart/form-data" method="post" action="/admin/event">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title">Create Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" class="form-control" id="name-input" placeholder="Enter event name"
                                    name="name">
                            </div>

                            <div class="form-group mt-3">
                                <label for="description-input">Description</label>
                                <x-rich-text-editor name="description" required="required"
                                    placeholder="Enter event description"></x-rich-text-editor>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label for="start-date-input">Start Date</label>
                                        <input id="start-date-input" type="date" class="form-control"
                                            placeholder='Enter Start Date here' name="start_date" required="">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-3">
                                        <label for="end-date-input">End Date</label>
                                        <input id="end-date-input" type="date" class="form-control"
                                            placeholder='Enter End Date here' name="end_date" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection
