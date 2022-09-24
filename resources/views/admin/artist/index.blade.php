@extends('admin.layouts.admin')

@section('content')


<div class="bg-light p-4 rounded">
    <h2>Artist</h2>
    <div class="lead">
        Manage your Artist here.
        <a href="{{ route('artist.create') }}" class="btn btn-primary btn-sm float-right">Add artist</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-bordered">
        <tr>
            <th width="1%">No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach ($artists as $key => $artist)
        <tr>
            <td>{{ $artist->id }}</td>
            <td>{{ $artist->image }}</td>
            <td>{{ $artist->cover }}</td>
            <td>{{ $artist->name }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('artist.show', $artist->id) }}">Show</a>
            </td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('artist.edit', $artist->id) }}">Edit</a>
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route' => ['artist.destroy', $artist->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex">
        {!! $artist->links() !!}
    </div>

</div>
@endsection