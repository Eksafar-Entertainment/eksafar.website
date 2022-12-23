@extends('admin.layouts.admin')

@section('content')


<div class="bg-light p-4 rounded">
    <h4>Artist</h4>
    <div class="lead">
        Manage your Artist here.
        <a href="{{ route('artist.create') }}" class="btn btn-primary btn-sm float-right">Add artist</a>
    </div>

    <div class="mt-2">
        @include('admin.layouts.partials.messages')
    </div>

    <div class="overflow-auto card rounded mt-4">
        <table class="table table-striped bg-white mb-0">
        <tr>
            <th width="1%">No</th>
            <th>Name</th>
            <th colspan="2">Action</th>
        </tr>
        @foreach ($artists as $key => $artist)
        <tr>
            <td>{{ $artist->id }}</td>
            <td>{{ $artist->name }}</td>
            <td width="1%">
                <a class="btn btn-primary btn-sm" href="{{ route('artist.edit', $artist->id) }}">Edit</a>
            </td>
            <td width="1%">
                {!! Form::open(['method' => 'DELETE','route' => ['artist.destroy', $artist->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </table>
    </div>


    <div class="d-flex mt-4">
        @include('admin.common.pagination', ['paginator' => $artists])
    </div>

</div>
@endsection


