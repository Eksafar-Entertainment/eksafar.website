@extends('admin.layouts.admin')

@section('content')
    <h4>New Contact</h4>
    <p class="text-muted">Add new post.</p>

    <div class="mt-4">

        <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name"
                    required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select value="{{ old('country') }}" class="form-control" name="country" placeholder="Country" required>
                    <option> </option>
                    @foreach (Countries::getList('en') as $code => $name)
                        <option value="{{ $code }}" @if (old('country') === $code) {{ 'selected' }} @endif>
                            {{ $name }}</option>
                    @endforeach
                </select>

                @if ($errors->has('country'))
                    <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" name="phone" value="{{old('phone')}}" placeholder="phone" class="form-control"/>
                @if ($errors->has('phone'))
                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="email" id="email" required>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input value="{{ old('address') }}" type="number" class="form-control" name="address"
                    placeholder="address" id="address" required>

                @if ($errors->has('address'))
                    <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Save Contact</button>
            <a href="{{ route('contact.index') }}" class="btn btn-default">Back</a>
        </form>
    </div>
@endsection
