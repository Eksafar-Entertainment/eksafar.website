@extends('admin.layouts.admin')

@section('content')
    <div style="max-width: 800px" class="m-auto mt-5">
        <h4>New Campaign</h4>
        <p class="text-muted">Add new campaign.</p>
        <div class="mt-4">

            <form method="POST" action="{{ route('campaign.store') }}" enctype="multipart/form-data">
                @csrf



                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name"
                                placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select value="{{ old('type') }}" type="text" class="form-select" name="type"
                                placeholder="type" id="type" required>
                                <option></option>
                                <option value="SMS">Sms</option>
                                <option value="MAIL">Email</option>
                                <option value="WHATSAPP">Whatsapp</option>

                            </select>

                            @if ($errors->has('type'))
                                <span class="text-danger text-left">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="content_type" class="form-label">Content Type</label>
                            <select value="{{ old('content_type') }}" type="text" class="form-select" name="content_type"
                                placeholder="content_type" id="content_type" required>
                                <option></option>
                                <option value="TEMPLATE">Template</option>
                                <option value="HTML">Html</option>
                                <option value="TEXT">Text</option>
                            </select>

                            @if ($errors->has('content_type'))
                                <span class="text-danger text-left">{{ $errors->first('content_type') }}</span>
                            @endif
                        </div>
                    </div>
                </div>





                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea type="text" class="form-control" name="content"
                        placeholder="content" id="content" required>{{ old('content') }}</textarea>

                    @if ($errors->has('content'))
                        <span class="text-danger text-left">{{ $errors->first('content') }}</span>
                    @endif
                </div>

                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="import_users">
                        <label class="form-check-label" for="import_users">
                          Import receipts from registerd users
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="import_ordered_users" checked>
                        <label class="form-check-label" for="import_ordered_users">
                            Import receipts from ordered users
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" id="import_contacts" checked>
                        <label class="form-check-label" for="import_contacts">
                            Import receipts from contacts
                        </label>
                      </div>
                </div>

                <div class="mt-5 text-end">
                    <a href="{{ route('campaign.index') }}" class="btn btn-danger">Back</a>
                    <button type="submit" class="btn btn-secondary">Save Campaign</button>
                   
                </div>
            </form>
        </div>
    </div>
@endsection
