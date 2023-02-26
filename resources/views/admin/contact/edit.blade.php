@extends('admin.layouts.admin')

@section('content')
    <h4>New Contact</h4>

    <div class="mt-4">

        <form method="POST" action="{{ route('contact.update', $contact->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Code" value="{{ $contact->name }}"
                    required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select value="{{ $contact->country }}" 
                    type="text" 
                    class="form-control" 
                    name="country" 
                    placeholder="Country" required>
                    <option> </option>
                    @foreach (Countries::getList('en') as $code => $name)
                        <option value="{{$code}}" @if($contact->country === $code) {{"selected"}} @endif>{{$name}}</option>
                    @endforeach

                </select>

                @if ($errors->has('country'))
                    <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" name="phone" value="{{$contact->phone }}" placeholder="phone" class="form-control"/>
                @if ($errors->has('phone'))
                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $contact->email }}" type="number" class="form-control" name="email" placeholder="email"
                    id="email" required>

                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>


            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input value="{{ $contact->address }}" type="number" class="form-control" name="address"
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
