@extends('admin.layouts.admin')

@section('content')
    <div>

        <div class="row">
            <div class="col">
                <h4>Campaign</h4>
                Manage your Campaign here.
            </div>
            <div class="col-auto">
                <a href="javascript:void()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">New
                    Campaign</a>
            </div>
        </div>

        <div class="mt-2">
            @include('admin.layouts.partials.messages')
        </div>

        <div class="overflow-auto card rounded mt-4">
            <table class="table table-striped bg-white mb-0">
                <tr>
                    <th width="1%">No</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th colspan="2">Action</th>
                </tr>
                @foreach ($campaigns as $key => $campaign)
                    <tr>
                        <td>{{ $campaign->id }}</td>
                        <td>{{ $campaign->name }}</td>
                        <td>{{ $campaign->type }}</td>
                        <td width="1%">
                            <a class="btn btn-primary btn-sm" href="{{ route('campaign.edit', $campaign->id) }}">Edit</a>
                        </td>
                        <td width="1%">
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['campaign.destroy', $campaign->id],
                                'style' => 'display:inline',
                                'onsubmit' => 'if(!confirm("Are you sure?")){event.preventDefault()}',
                            ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-link']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


        <div class="d-flex mt-4">
            @include('admin.common.pagination', ['paginator' => $campaigns])
        </div>


        <!-- Modal -->
        <div class="modal fade modal-sm" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new campaign</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="new-form" method="POST" action="{{ route('campaign.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mt-3">
                                <label class="form-control-label">Name</label>
                                <input type="text" class="form-control" name="name" required />
                            </div>
                            <div class="mt-3">
                                <label class="form-control-label">Type</label>
                                <select type="text" class="form-select" name="type" placeholder="type" id="type"
                                    required
                                    onchange="handleOnChangeType(event)">
                                    <option></option>
                                    <option value="SMS">Sms</option>
                                    <option value="MAIL">Email</option>
                                    <option value="WHATSAPP">Whatsapp</option>
                                </select>
                            </div>

                            <div class="mt-3" id="content_type_container" style="display: none">
                                <label class="form-control-label">Content Type</label>
                                <select type="text" class="form-select" name="content_type" placeholder="Content type"
                                    id="content_type" required>
                                    <option></option>
                                    <option value="TEMPLATE">Template</option>
                                    <option value="HTML">Html</option>
                                    <option value="TEXT">Text</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" type="submit" form="new-form">Create
                            Campaign</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const handleOnChangeType = (_evt) =>{
                document.querySelector('#content_type_container').style.display = _evt.target.value == 'SMS' ? 'none':'inherit';
                document.querySelector("#content_type").value = "";
            }
        </script>
    </div>
@endsection
