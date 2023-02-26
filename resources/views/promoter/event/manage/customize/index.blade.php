@extends('promoter.layouts.admin')
@section('subnav')
    @include('promoter.event.partials.subnav')
@endsection
@section('content')
    <div>
        <h4>Customize Event</h4>

        <div class="card mt-4" id="general">
            <div class="card-header">General</div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post">
                    @csrf

                    <x-image-chooser class="border border-grey mb-3" height="200px" width="100%" :value="$event->cover_image"
                        name="cover_image" />

                    <div class="mb-3">
                        <label for="name">Name</label>

                        <div>
                            <input id="name" type="text" class="form-control" placeholder='Enter Name here'
                                name="name" value="{{ $event ? $event->name : '' }}" required="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="event_type">Event Type</label>

                                <div>
                                    <input id="event_type" type="text" class="form-control"
                                        placeholder='Enter Event Type here' name="event_type"
                                        value="{{ $event ? $event->event_type : '' }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="entry_type">Entry Type</label>
                                <div>
                                    <select id="entry_type" class="form-select" name="entry_type" required="">
                                        <option></option>
                                        <option {{ $event && $event->entry_type == 'Normal' ? 'selected' : '' }}>Normal
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="venue">Venue</label>
                                <div>
                                    <x-selectize :options="$venues" name="venue" :selected="$event ? $event->venue : ''"></x-selectize>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="language">Language</label>

                                <div>
                                    <input id="language" type="text" class="form-control"
                                        placeholder='Enter Language here' name="language"
                                        value="{{ $event ? $event->language : '' }}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="start_date">Start Date</label>

                                <div>
                                    <input id="start_date" type="date" class="form-control"
                                        placeholder='Enter Start Date here' name="start_date"
                                        value="{{ $event ? $event->start_date : '' }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="end_date">End Date</label>

                                <div>
                                    <input id="end_date" type="date" class="form-control"
                                        placeholder='Enter End Date here' name="end_date"
                                        value="{{ $event ? $event->end_date : '' }}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="occurrence">Occurrence</label>

                                <div>
                                    <select id="occurrence" type="text" class="form-select" name="occurrence"
                                        required="">
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
                                    <input id="abilities" type="text" class="form-control"
                                        placeholder='Enter Abilities here' name="abilities"
                                        value="{{ $event ? $event->abilities : '' }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="artist">Location</label>
                                <x-selectize :options="$locations" :multiple="false" name="location" :selected="$event->location">
                                </x-selectize>
                            </div>
                        </div>


                        {{-- <div class="col-md-3">
                            <div class="mb-3">
                                <label for="city">City</label>

                                <div>
                                    <input id="city" type="text" class="form-control"
                                        placeholder='Enter City here' name="city"
                                        value="{{ $event ? $event->city : '' }}" required="">
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="address">Address</label>

                                <div>
                                    <input id="address" type="text" class="form-control"
                                        placeholder='Enter Address here' name="address"
                                        value="{{ $event ? $event->address : '' }}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="video_link">Video Link</label>

                                <div>
                                    <input id="video_link" type="text" class="form-control"
                                        placeholder='Enter Video Link here' name="video_link"
                                        value="{{ $event ? $event->video_link : '' }}" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="min_age">Minimum Age</label>

                                <div>
                                    <input id="min_age" type="number" class="form-control"
                                        placeholder='Enter minimum age here' name="min_age"
                                        value="{{ $event ? $event->min_age : '' }}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="excerpt">Excerpt</label>

                        <div>
                            <textarea class="form-control" name="excerpt" required="required" placeholder="Enter event excerpt" required>{{ $event->excerpt }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>

                        <div>
                            <x-rich-text-editor name="description" required="required"
                                placeholder="Enter event description" required>{!! $event ? html_entity_decode($event->description) : '' !!}</x-rich-text-editor>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="terms">Terms & Conditions</label>

                        <div>
                            <x-rich-text-editor name="terms" required="required"
                                placeholder="Enter event terms and conditions" required>{!! $event ? html_entity_decode($event->terms) : '' !!}
                            </x-rich-text-editor>
                            {{-- <textarea id="terms" class="form-control rich-text" placeholder='Enter Terms and conditions here' name="terms"
                                required="">{!! $event ? html_entity_decode($event->terms) : '' !!}</textarea> --}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="artist">Artists</label>
                        <x-selectize :options="$artists" :multiple="true" name="artists[]" :selected="$event->artists"></x-selectize>
                    </div>

                    <button class="btn btn-primary">Save Event</button>
                </form>
            </div>
        </div>
        <div class="card mt-4" id="album">
            <div class="card-header">Album</div>
            <div class="card-body">
                <div class="row">
                    @foreach ($event_album_images as $event_album_image)
                        <div class="col-md-2 col-sm-3 col-6">
                            <div class="position-relative border"
                                style="width:100%; padding-top: 100%; background-size:cover; background-position:center; background-image:url('{{ url('/storage/uploads/' . $event_album_image->image) }}')">
                                <form class="position-absolute" style="top: 0; right:0"
                                    action="{{ url('/admin/event/' . $event->id . '/customize/album-images') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <input type="hidden" name="event_album_image_id"
                                        value="{{ $event_album_image->id }}" />
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form action="{{ url('/admin/event/' . $event->id . '/customize/album-images') }}" id="album_image_form"
                    class="mt-4" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <input class="form-control form-control-sm" type="file" name="image" />
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-sm btn-primary" type="submit">Upload</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>
@endsection
