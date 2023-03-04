@extends('admin.layouts.admin')

@section('content')
    <h4>Edit Campaign Settings</h4>
    <div class="mt-4">

        <form method="POST" action="{{ route('campaign.update', $campaign->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $campaign->name }}"
                    required>
                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Content Type</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $campaign->name }}"
                    required>
                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Save Campaign</button>
        </form>
    </div>
@endsection
