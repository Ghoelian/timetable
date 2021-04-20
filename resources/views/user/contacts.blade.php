@extends('layouts.head')

@section('title', 'Contacts')

@push('assets')
    <script>
        $(document).ready(() => {
            $('.contact-enabled').change((e) => {
                    const contactId = e.target.id

                    let formData = new FormData();

                    formData.append('_token', '{{ csrf_token() }}')
                    formData.append('contact-id', contactId)

                    $.ajax({
                            url: '{{ route('user/contacts/toggle') }}',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false
                        })
                        .done((result) => {
                            showSuccess(result)
                        })
                        .fail((error) => {
                            showError(error)
                        })
                })
        })
    </script>
@endpush

@section('content')
<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('user/contacts/add') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required />
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Enabled</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td><input type="checkbox" {{ $contact->enabled ? 'checked' : '' }} class="contact-enabled" id="{{ $contact->id }}" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addContactModal">New Contact</button>
@endsection
