@extends('admin.layouts.admin')

@section('content')

<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Admins</a></li>
          <li class="breadcrumb-item active"><a>{{$admin->name}}</a></li>
        </ol>
      </nav>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $admin->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $admin->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Roles:</strong>
                @if (!empty($admin->getRoleNames()))
                    @foreach ($admin->getRoleNames() as $v)
                        <label class="badge bg-success">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
