@extends('admin.layouts.admin')

@section('content')

    <h1 class="mb-3">Eksafar Club</h1>

    <div class="bg-light p-4 rounded">
        <h2>Posts</h2>
        <div class="lead">
            Manage your promoters here.
            <a href="{{ route('promoters.create') }}" class="btn btn-primary btn-sm float-right">Add promoter</a>
        </div>

        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Name</th>
             <th>Commission</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($promoters as $key => $promoter)
            <tr>
                <td>{{ $promoter->id }}</td>
                <td>{{ $promoter->name }}</td>
                <td>{{ $promoter->commission }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('promoters.show', $promoter->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('promoters.edit', $promoter->id) }}">Edit</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['promoters.destroy', $promoter->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>

        <div class="d-flex">
            {!! $promoters->links() !!}
        </div>

    </div>
@endsection