@extends('admin.layouts.admin')

@section('content')
    <div>

        <div class="d-flex">
            <div class="flex-grow-1">
                <h4>{{ __('User Management') }}</h4>
                <p class="text-muted">Manage your users here.</p>
            </div>
            <div class="">
                <a class="btn btn-sm btn-success" href="{{ route('users.create') }}">New User</a>
            </div>
        </div>


        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="overflow-auto card rounded mt-4">
            <table class="table table-striped bg-white mb-0">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th colspan="3">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td width="1%">{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->mobile }}
                        </td>
                        <td width="1%">
                            <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}"><i
                                    class="fas fa-pencil"></i></a>
                        </td>
                        <td width="1%">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            {!! Form::button('<i class="fas fa-trash"></i>', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


        <div class="d-flex mt-4">
            @include('admin.common.pagination', ['paginator' => $data])
        </div>
    @endsection
