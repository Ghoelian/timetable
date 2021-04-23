@extends('layouts.head')

@section('title', 'Home')

@section('content')
    <div class="modal fade" id="logTimeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('log-time') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="incident" class="col-form-label">Incident</label>
                            <select class="form-control" id="incident" name="incident" required>
                                @foreach ($incidents as $incident)
                                    <option value="{{ $incident->id }}">{{ $incident->incident_number }} -
                                        {{ $incident->description }} ({{ $incident->status->name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time-spent" class="col-form-label">Time Spent</label>
                            <input type="text" class="form-control" id="time-spent" name="time-spent"
                                placeholder="HH:MM (24h)" required />
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
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
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    @if ($task->incident->incident_number === 'Miscellaneous')
                        <td><a href="https://itsm.asus.com/apps/#/IncidentConsoleDetail/{{ $task->incident->incident_number }}">{{ $task->incident->incident_number }}</a></td>
                    @else
                        <td>{{ $task->incident->incident_number }}</td>
                    @endif
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->getTime() }}</td>
                </tr>
            @endforeach
            <tr class="table-secondary">
                <th scope="row">Total ({{ count($tasks) }})</th>
                <td></td>
                <th scope="row">{{ sprintf('%02d', $totalHours) . ':' . sprintf('%02d', $totalMinutes) }}</th>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logTimeModal">Log Time</button>
@endsection
