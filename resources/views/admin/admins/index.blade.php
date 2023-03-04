@extends('admin.layouts.admin')

@section('content')
    <div>

        <div class="d-flex">
            <div class="flex-grow-1">
                <h4>{{ __('Admins') }}</h4>
            </div>
            <div class="">
                <a class="btn btn-sm btn-secondary" href="{{ route('admins.create') }}">New Admin</a>
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
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th></th>
                </tr>
                @foreach ($data as $key => $admin)
                    <tr>
                        <td width="1%">{{ ++$i }}</td>
                       
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            @if (!empty($admin->getRoleNames()))
                                @foreach ($admin->getRoleNames() as $v)
                                    <label class="badge bg-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td width='1%' nowrap>
                            <a href="{{ route('admins.show', $admin->id) }}" class="mx-1"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admins.edit', $admin->id) }}" class="mx-1"><i class="fas fa-pencil"></i></a>

                            {!! Form::open(['method' => 'DELETE', 'route' => ['admins.destroy', $admin->id], 'style' => 'display:inline', 'onclick'=>'if(!confirm("Are you sure?")){event.preventDefault();};', 'class'=>'mx-1']) !!}
                            {!! Form::button('<i class="fas fa-trash"></i>', ['class' => 'border-0 bg-transparent text-danger', 'type' => 'submit']) !!}
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
