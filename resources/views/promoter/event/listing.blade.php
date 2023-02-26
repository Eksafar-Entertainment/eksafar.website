@extends('promoter.layouts.admin')
@section('content')
    <div>


        <h4 class="flex-grow-1">{{ __('Events') }}</h4>

    </div>

    <div>
        <form>
            <div class="row">
                <div class="col-auto">
                    <input class="form-control" type="date" name="fromDate"
                        value="{{ app('request')->input('fromDate') }}" />
                </div>
                <div class="col-auto">
                    <input class="form-control" type="date" name="toDate" value="{{ app('request')->input('toDate') }}" />
                </div>

                <div class="col-auto">
                    <select class="form-select" type="date" name="status"
                        value="{{ app('request')->input('toDate') }}">
                        <option value="">---STATUS---</option>
                        <option {{ app('request')->input('status') === 'CREATED' ? 'selected' : '' }}>CREATED</option>
                        <option {{ app('request')->input('status') === 'CLOSED' ? 'selected' : '' }}>CLOSED</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
                <div class="col">
                </div>
            </div>
        </form>
    </div>


    <div class="row mt-4">
        @foreach ($events as $index => $event)
            @php
                $revenue = isset($sales[$event->id]) ? $sales[$event->id]['revenue'] : 0;
                $quantity = isset($sales[$event->id]) ? $sales[$event->id]['quantity'] : 0;
            @endphp
            <div class="col-md-4 mb-4">
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
                    </div>
             
                    <div class="card-footer p-0">
                        <div class="btn-group d-flex" role="group" aria-label="Basic example">
                
                                <a class="btn btn-light flex-grow-1 text-primary"
                                    href="{{ url('/promoter/event/' . $event->id . '/dashboard') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                  
                    
                                {{-- <a class="btn btn-light flex-grow-1 text-primary"
                                    href="{{ url('/admin/event/' . $event->id . '/orders') }}">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </a> --}}
                     
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

    <div class="mt-2 text-end">
        @include('promoter.common.pagination', ['paginator' => $events])
    </div>
    </div>
@endsection
