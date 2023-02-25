@extends('admin.layouts.admin')

@section('content')
    <div>
        <h4>Contacts</h4>
        <div class="d-flex">
            <div class="flex-grow-1">Manage your Contact here.</div>
            <a href="{{ route('contact.create') }}" class="btn btn-secondary btn-sm float-right">Add contact</a>
            <a class="btn btn-secondary btn-sm float-right ms-2" data-bs-toggle="modal" data-bs-target="#import-modal">Import</a>
            <a class="btn btn-success btn-sm float-right ms-2" data-bs-toggle="modal"
                data-bs-target="#whatsapp-campaign-modal">Whatsapp Message</a>
        </div>

        <div class="mt-2">
            @include('admin.layouts.partials.messages')
        </div>

        <div class="overflow-auto">
            <table class="table table-small">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key => $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->country }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->address }}</td>
                            <td width="1%" nowrap>
                                <a class="btn btn-sm btn-primary" href="{{ route('contact.edit', $contact->id) }}">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <div class="flex-grow-1 d-inline-flex align-items-center">
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['contact.destroy', $contact->id],
                                        'class' => 'd-block flex-grow-1',
                                    ]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger w-100']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex mt-4">
            @include('admin.common.pagination', ['paginator' => $contacts])
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-sm" id="import-modal" tabindex="-1" aria-labelledby="import-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="import-modalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onsubmit="importExcel(event)" id="import-form">
                        @csrf
                        <div>
                            <label>Excel File</label>
                            <input class="form-control" type="file" name="file" accept=".xls,.xlsx" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="import-form">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade modal-sm" id="whatsapp-campaign-modal" tabindex="-1"
        aria-labelledby="whatsapp-campaign-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="whatsapp-campaign-modalLabel">Send whatsapp message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onsubmit="whatsappCampaign(event)" id="whatsapp-campaign-form">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" style="height: 150px" required></textarea>
                        </div>
                        <div class="mb-3">
                            <kbd>@php echo "{{name}}" @endphp</kbd>
                            <kbd>@php echo "{{email}}" @endphp</kbd>
                        </div>

                        <div class="mb-1">
                            <label class="form-label">Message</label>
                            <input class="form-control" name="receipt" type="number"></textarea>
                        </div>

                        <p class="text-center">---------- OR ----------</p>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" 
                                name="to_contacts">
                            <label class="form-check-label">To Contacts</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" name="to_registered_users">
                            <label class="form-check-label">To Registered users</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" name="to_ordered_users">
                            <label class="form-check-label">To Ordered Users</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm" form="whatsapp-campaign-form">Send Whatsapp Message</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            window.importModal = new bootstrap.Modal(document.getElementById('import-modal'), {});
            window.whatsappCampaignModal = new bootstrap.Modal(document.getElementById(
                'whatsapp-campaign-modal'), {});
        })

        function importExcel(_evt) {
            _evt.preventDefault();
            jQuery.ajax({
                url: "{{ url('/admin/contact/import/') }}",
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData(_evt.target),
                success: function(result) {
                    alert(result.message);
                    //window.location.reload();
                    //importModal.hide();
                }
            });
        }

        function whatsappCampaign(_evt) {
            _evt.preventDefault();
            jQuery.ajax({
                url: "{{ url('/admin/contact/whatsapp-campaign') }}",
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData(_evt.target),
                success: function(result) {
                    alert(result.message);
                    importModal.hide();
                }
            });
        }
    </script>
@endsection
