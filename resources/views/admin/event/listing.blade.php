@include("admin.common.header")


<div class="container py-2">
    <h2>Events</h2>

        <table class="table table-striped table-hover table-bordered">
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
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
    <div class="mt-2 text-end">
        @include('admin.common.pagination', ['paginator' => $events])
    </div>
</div>

@include("admin.common.footer")