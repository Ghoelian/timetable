@extends('layouts.head')

@section('title', 'Totals')

@section('content')
<div class="modal fade" id="sendReportModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="float-right" action="{{ route('totals/send', ['scope' => $scope, 'aggregate' => $aggregate]) }}" method="POST">
                    @csrf
                    
                    <div class="modal-header">
                        <h5 class="modal-title">Log Time</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/BLikP6BDH5w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'day' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'day', 'aggregate' => $aggregate]) }}">Day</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'week' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'week', 'aggregate' => $aggregate]) }}">Week</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'last_week' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'last_week', 'aggregate' => $aggregate]) }}">Last Week</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'month' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'month', 'aggregate' => $aggregate]) }}">Month</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'year' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'year', 'aggregate' => $aggregate]) }}">Year</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'all_time' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'all_time', 'aggregate' => $aggregate]) }}">All Time</a>
        </li>
    </ul>

    <form class="float-left">
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="aggregate" name="aggregate"
                onclick="window.location.replace('{{ route('totals', ['scope' => $scope, 'aggregate' => !$aggregate]) }}')"
                {{ $aggregate ? 'checked' : '' }} />
            <label for="aggregate" class="form-check-label">Aggregate</label>
        </div>
    </form>

    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#sendReportModal">Send as report</button>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">Incident Number</th>
                <th scope="col">Description</th>
                <th scope="col">Time Spent</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-secondary">
                <th scope="row">Total ({{ count($tasks) }})</th>
                <td></td>
                <th scope="row">{{ $totalHours . ':' . sprintf('%02d', $totalMinutes) }}</th>
            </tr>
            @foreach ($tasks as $incident => $details)
                <tr>
                    @if ($details['incident']['incident_number'] !== 'Miscellaneous')
                        <td><a href="https://itsm.asus.com/apps/#/IncidentConsoleDetail/{{ $details['incident']['incident_number'] }}">{{ $details['incident']['incident_number'] }}</a></td>
                    @else
                        <td>{{ $details['incident']['incident_number'] }}</td>
                    @endif
                    <td>{{ $details['description'] }}</td>
                    <td>{{ $details['hours'] . ':' . $details['minutes'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
