@extends('layouts.head')

@section('title', 'Totals')

@section('content')
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
    
    <form class="float-right" action="{{ route('totals/send', ['scope' => $scope, 'aggregate' => $aggregate]) }}" method="POST">
        @csrf

        <button class="btn btn-primary">Send as report</button>
    </form>

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
