@extends('admin.layouts.admin')

@section('content')

<h4>New Artist</h4>
<p class="text-muted">Add new post.</p>

<div class="mt-4">

    <form method="POST" action="{{ route('artist.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 bg-secondary position-relative border" id="preview-cover" style="height: 250px;  background-size:cover; background-position:center">
            <label for="image" class="d-inline-block">
                <div class="bg-primary border" id="preview-image" style="height: 150px; width: 150px; margin: 75px 0 25px 25px; background-size:cover; background-position:center"></div>
                <input style="display:none" type="file" class="form-control cropper-input" data-ratio="1/1" data-preview="#preview-image" name="image" placeholder="image" id="image" required>
            </label>

            <label for="cover" class="form-label" style="position: absolute; right: 25px; bottom:25px">
                <a class="btn btn-sm btn-primary" type="button">Select Cover</a>
                <input style="display:none" type="file" class="form-control cropper-input" data-ratio="1/3" data-preview="#preview-cover" name="cover" placeholder="cover" id="cover" required>
            </label>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>

            @if ($errors->has('name'))
            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">phone</label>
            <input value="{{ old('phone') }}" type="text" class="form-control" name="phone" placeholder="phone" id="phone" required>

            @if ($errors->has('phone'))
            <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="email" id="email" required>

            @if ($errors->has('email'))
            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="excerpt" class="form-label">excerpt</label>
            <input value="{{ old('excerpt') }}" type="text" class="form-control" name="excerpt" placeholder="excerpt" id="excerpt" required>

            @if ($errors->has('excerpt'))
            <span class="text-danger text-left">{{ $errors->first('excerpt') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input value="{{ old('description') }}" type="text" class="form-control" name="description" placeholder="description" id="description" required>

            @if ($errors->has('description'))
            <span class="text-danger text-left">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">tags</label>
            <input value="{{ old('tags') }}" type="text" class="form-control" name="tags" placeholder="tags" id="tags" required>

            @if ($errors->has('tags'))
            <span class="text-danger text-left">{{ $errors->first('tags') }}</span>
            @endif
        </div>


        <button type="submit" class="btn btn-primary">Save Artist</button>
        <a href="{{ route('artist.index') }}" class="btn btn-default">Back</a>
    </form>
</div>


@endsection