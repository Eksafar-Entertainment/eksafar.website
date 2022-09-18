@extends('admin.layouts.admin')

@section('subnav')
@include('admin.event.manage.partials.subnav', ['active' => 'customize'])
@endsection

@section('content')
<div>
    @if(Auth::user()->can('event:customize'))
    <div>
        <h4>Customize Event</h4>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="design-tab" data-bs-toggle="tab" data-bs-target="#design" type="button" role="tab" aria-controls="design" aria-selected="false">Design</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ticket-design-tab" data-bs-toggle="tab" data-bs-target="#ticket-design" type="button" role="tab" aria-controls="ticket-design" aria-selected="false">Ticket Design</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="card card-body border-top-0">
                    <form enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>

                            <div>
                                <input id="name" type="text" class="form-control" placeholder='Enter Name here' name="name" value="{{$event ? $event->name:''}}" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="event_type">Event Type</label>

                                    <div>
                                        <input id="event_type" type="text" class="form-control" placeholder='Enter Event Type here' name="event_type" value="{{$event ? $event->event_type:''}}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="entry_type">Entry Type</label>
                                    <div>
                                        <select id="entry_type" class="form-select" name="entry_type" required="">
                                            <option></option>
                                            <option {{$event && $event->entry_type =='Normal'?"selected":"" }}>Normal</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="venue">Venue</label>

                                    <div>
                                        <input id="venue" type="text" class="form-control" placeholder='Enter Venue here' name="venue" value="{{$event ? $event->venue:''}}" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="start_date">Start Date</label>

                                    <div>
                                        <input id="start_date" type="date" class="form-control" placeholder='Enter Start Date here' name="start_date" value="{{$event ? $event->start_date:''}}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="end_date">End Date</label>

                                    <div>
                                        <input id="end_date" type="date" class="form-control" placeholder='Enter End Date here' name="end_date" value="{{$event ? $event->end_date:''}}" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="occurrence">Occurrence</label>

                                    <div>
                                        <select id="occurrence" type="text" class="form-select" name="occurrence" required="">
                                            <option value="1">Once</option>
                                            <option value="2">Multiple</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="abilities">Abilities</label>

                                    <div>
                                        <input id="abilities" type="text" class="form-control" placeholder='Enter Abilities here' name="abilities" value="{{$event ? $event->abilities:''}}" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="city">City</label>

                                    <div>
                                        <input id="city" type="text" class="form-control" placeholder='Enter City here' name="city" value="{{$event ? $event->city :''}}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address">Address</label>

                                    <div>
                                        <input id="address" type="text" class="form-control" placeholder='Enter Address here' name="address" value="{{$event ? $event->address:''}}" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cover_image">Cover Image</label>

                                    <div>
                                        <input id="cover_image" type="file" class="form-control" placeholder='Enter Cover Image here' name="cover_image">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="video_link">Video Link</label>

                                    <div>
                                        <input id="video_link" type="text" class="form-control" placeholder='Enter Video Link here' name="video_link" value="{{$event ? $event->video_link:''}}" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>

                            <div>
                                <textarea id="description" class="form-control rich-text" placeholder='Enter Description here' name="description" required="">{!!$event ? html_entity_decode($event->description):''!!}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="artist">Artist</label>

                            <div>
                                <textarea id="artist" type="text" class="form-control rich-text" placeholder='Enter Artist here' name="artist" required="">{{$event ? $event->artist:''}}</textarea>
                            </div>
                        </div>



                        <button class="btn btn-primary">Save Event</button>

                    </form>
                </div>
            </div>
            <div class="tab-pane" id="design" role="tabpanel" aria-labelledby="design-tab">

                <div class="card card-body border-top-0">
                    Coming Soon
                </div>
            </div>

            <div class="tab-pane" id="ticket-design" role="tabpanel" aria-labelledby="ticket-design-tab">

                <div class="card card-body border-top-0">
                    Coming Soon
                </div>
            </div>
        </div>
    </div>
    @else
    @include("admin.layouts.partials.access-denied");
    @endif
</div>
@endsection