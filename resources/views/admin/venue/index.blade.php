@extends('admin.layouts.admin')

@section('content')


<div class="bg-light p-4 rounded">
    <h2>Venues</h2>
    <div class="lead">
        Manage your venue here.
        <a href="{{ route('venue.create') }}" class="btn btn-primary btn-sm float-right">Add venue</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">No</th>
            <th>Name</th>
            <th width="3%" colspan="3">Action</th>
        </tr>
        @foreach ($venues as $key => $venue)
        <tr>
            <td>{{ $venue->id }}</td>
            <td>{{ $venue->title }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('venue.show', $venue->id) }}">Show</a>
            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('venue.edit', $venue->id) }}">Edit</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route' => ['venue.destroy', $venue->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex">
        {!! $venues->links() !!}
    </div>

</div>
@endsection