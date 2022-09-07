@extends('admin.layouts.admin')

@section('content')


<div class="d-flex">
    <div class="flex-grow-1">
        <h2>Promoters</h2>
        Manage your promoters here.
    </div>
    <div>
        <a href="{{ route('promoters.create') }}" class="btn btn-primary btn-sm float-right">Add promoter</a>
    </div>
</div>

<div class="mt-4">
    <form>
        <div class="row">
            <input type="hidden" name="page" value="{{app('request')->input('page')}}" />
            <div class="col-auto">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    <input class="form-control" placeholder="Search promoter" name="keyword" value="{{app('request')->input('keyword')}}" />
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
</div>

<div class="mt-2">
    @include('layouts.partials.messages')
</div>
<div class="card mt-4">
    <div class="card-body">
        @if(count($promoters)>0)
        <table class="table table-divider table-hover">
            <thead>
                <tr>
                    <th scope="col" width="1%">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Commission</th>
                    <th scope="col" width="3%"></th>
                </tr>
            </thead>
            @foreach ($promoters as $key => $promoter)
            <tr>
                <td>{{ $promoter->id }}</td>
                <td>{{ $promoter->name }}</td>
                <td>{{ $promoter->commission }}%</td>
                <td>
                    <div class="dropdown">
                        <a type="button" id="dropdownMenuButton{{$promoter->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$promoter->id}}">
                            <li> <a class="dropdown-item" href="{{ route('promoters.show', $promoter->id) }}">Show</a></li>
                            <li> <a class="dropdown-item" href="{{ route('promoters.edit', $promoter->id) }}">Edit</a></li>
                            <li>
                                {!! Form::open(['method' => 'DELETE','route' => ['promoters.destroy', $promoter->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        @else
        <div class="text-center">

            <p class="mb-0"><i class="fas fa-circle-info"></i> No data found</p>
        </div>
        @endif
    </div>
</div>

<div class="d-flex mt-4">
    @include('admin.common.pagination', ["paginator"=>$promoters])
</div>


@endsection