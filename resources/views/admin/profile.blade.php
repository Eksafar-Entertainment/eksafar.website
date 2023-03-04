@extends('admin.layouts.admin')

@section('content')
    <div style="max-width: 800px; margin:auto">
        <h4>Profile</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-6">
                <div class="card mb-4">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" id="profile-form">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-sm-3 text-sm-end">
                                    <label class="col-form-label">Name</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-control" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>

                            <div class="row align-items-center mt-2">
                                <div class="col-sm-3 text-sm-end">
                                    <label class="col-form-label">Email</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-control" name="email" type="email" value="{{ $user->email }}"
                                        required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit" form="profile-form">Save Profile</button>
                    </div>

                </div>
            </div>


            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <form method="POST" id="password-form" action="/admin/profile/change-password">
                            @csrf
                            <div class="row align-items-center mb-2">
                                <div class="col-sm-4 text-sm-end">
                                    <label class="col-form-label">Old Password</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-control" name="current_password" type="password" required>
                                </div>
                            </div>

                            <div class="row align-items-center mb-2">
                                <div class="col-sm-4 text-sm-end">
                                    <label class="col-form-label">New Password</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-control" name="new_password" type="password" required>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-sm-4 text-sm-end">
                                    <label class="col-form-label">New Password</label>
                                </div>
                                <div class="col-sm">
                                    <input class="form-control" name="confirm_password" type="password" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit" form="password-form">Change Password</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
