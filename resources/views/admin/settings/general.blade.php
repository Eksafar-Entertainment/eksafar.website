@extends('admin.layouts.admin')

@section('content')
    <div>

        <div class="card card-body">
            <h4 class="mb-3">Popup Banner</h4>
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-auto mb-3">
                        <div>
                            <label class="form-label">Desktop Image</label>
                            <x-image-chooser class="border border-grey" height="150px" width="240px" :value="@$settings->popup_banner->image_desktop"
                                name="popup_banner[image_desktop]" />
                        </div>
                    </div>
                    <div class="col-auto mb-3">
                        <div>
                            <label class="form-label">Mobile Image</label>
                            <x-image-chooser class="border border-grey" height="150px" width="110px" :value="@$settings->popup_banner->image_mobile"
                                name="popup_banner[image_mobile]" />
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="popup-banner-link" class="form-label">Link</label>
                            <input type="text" class="form-control" id="popup-banner-link"
                                placeholder="https://example.com" name="popup_banner[link]" value="{{@$settings->popup_banner->link}}">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="true" id="popup-banner-active" name="popup_banner[active]" {{@$settings->popup_banner->active ? "checked": ""}}>
                            <label class="form-check-label" for="opup-banner-active">
                              Active
                            </label>
                          </div>
                       
                        <button class="btn btn-primary">Save Setting</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
