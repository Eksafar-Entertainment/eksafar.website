@extends('admin.layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h2>Update promoter</h2>
        <div class="lead">
            Edit promoter.
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('promoters.update', $promoter->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $promoter->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $promoter->email  }}" 
                        type="text" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email" required>

                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input value="{{ $promoter->mobile  }}" 
                        type="text" 
                        class="form-control" 
                        name="mobile" 
                        placeholder="Mobile" required>

                    @if ($errors->has('mobile'))
                        <span class="text-danger text-left">{{ $errors->first('mobile') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="password" 
                        placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="commission" class="form-label">Commission</label>
                    <input value="{{ $promoter->commission }}" 
                        type="text" 
                        class="form-control" 
                        name="commission" 
                        placeholder="Commission" required>

                    @if ($errors->has('commission'))
                        <span class="text-danger text-left">{{ $errors->first('commission') }}</span>
                    @endif
                </div>

    
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('promoters.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection