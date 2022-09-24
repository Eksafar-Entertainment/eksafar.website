@extends('admin.layouts.admin')

@section('content')
    <h4>New Venue</h4>
    <p class="text-muted">Add new post.</p>

    <div class="mt-4">

        <form method="POST" action="{{ route('venue.store') }}" enctype="multipart/form-data">
            @csrf


            <!----- Image Chooser --->
            <x-image-chooser class="border border-grey p-4" height="auto" width="100%" :value="null" name="cover">
                <x-image-chooser class="border border-grey mt-5" height="150px" width="150px" :value="null" name="logo"/>
            </x-image-chooser>
            



            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name"
                    required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label">mobile</label>
                <input value="{{ old('mobile') }}" type="text" class="form-control" name="mobile" placeholder="mobile"
                    id="mobile" required>

                @if ($errors->has('mobile'))
                    <span class="text-danger text-left">{{ $errors->first('mobile') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="email"
                    id="email" required>

                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">excerpt</label>
                <input value="{{ old('excerpt') }}" type="text" class="form-control" name="excerpt" placeholder="excerpt"
                    id="excerpt" required>

                @if ($errors->has('excerpt'))
                    <span class="text-danger text-left">{{ $errors->first('excerpt') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <input value="{{ old('description') }}" type="text" class="form-control rich-text" name="description"
                    placeholder="description" id="description" required>

                @if ($errors->has('description'))
                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">location</label>
                <input value="{{ old('location') }}" type="text" class="form-control" name="location"
                    placeholder="location" id="location" required>

                @if ($errors->has('location'))
                    <span class="text-danger text-left">{{ $errors->first('location') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">address</label>
                <input value="{{ old('address') }}" type="text" class="form-control" name="address"
                    placeholder="address" id="address" required>

                @if ($errors->has('address'))
                    <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="founded_at" class="form-label">founded_at</label>
                <input value="{{ old('founded_at') }}" type="text" class="form-control" name="founded_at"
                    placeholder="founded_at" id="founded_at" required>

                @if ($errors->has('founded_at'))
                    <span class="text-danger text-left">{{ $errors->first('founded_at') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">tags</label>
                <input value="{{ old('tags') }}" type="text" class="form-control" name="tags" placeholder="tags"
                    id="tags" required>

                @if ($errors->has('tags'))
                    <span class="text-danger text-left">{{ $errors->first('tags') }}</span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary">Save Venue</button>
            <a href="{{ route('venue.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>
@endsection
