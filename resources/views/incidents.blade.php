@extends('layouts.head')

@section('title', 'Incidents')

    @push('assets')
        <script>
            $(document).ready(() => {
                $('.incident-status').change((e) => {
                    const incidentId = e.target.id
                    const statusId = e.target.value

                    let formData = new FormData();

                    formData.append('_token', '{{ csrf_token() }}')
                    formData.append('incident-id', incidentId)
                    formData.append('status-id', statusId)

                    $.ajax({
                            url: '{{ route('incident/update/status') }}',
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
    <div class="modal fade" id="addIncidentModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Incident</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('incidents') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="incident-number" class="col-form-label">Incident Number</label>
                            <input type="text" class="form-control" id="incident-number" name="incident-number" required />
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
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
                <th scope="col">Incident Number</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incidents as $incident)
                <tr>
                    <td>{{ $incident->incident_number }}</td>
                    <td>{{ $incident->description }}</td>
                    <td>
                        <select class="form-control col-sm-8 incident-status" id="{{ $incident->id }}"
                            name="incident-status">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $incident->status->id === $status->id ? 'selected' : '' }}>{{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><button class="btn btn-primary">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIncidentModal">Add Incident</button>
@endsection
