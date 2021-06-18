@extends('layouts.head')

@section('title', 'Totals')

@section('content')
    <div class="modal fade" id="sendReportModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="float-right"
                    action="{{ route('totals/send', ['scope' => $scope, 'aggregate' => $aggregate]) }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Log Time</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        Are you sure about that?
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
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'custom' ? 'active' : '' }}"
                href="{{ route('totals', ['scope' => 'custom', 'aggregate' => $aggregate]) }}">Custom</a>
        </li>
    </ul>

    <form method="GET" class="float-left form-inline">
        <input type="text" class="d-none" name="scope" value="{{ $scope }}" />
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="aggregate" name="aggregate"
                onclick="window.location.replace('{{ route('totals', ['scope' => $scope, 'aggregate' => !$aggregate, 'from' => $from, 'to' => $to]) }}')"
                {{ $aggregate ? 'checked' : '' }} />
            <label for="aggregate" class="form-check-label">Aggregate</label>
        </div>

        @if ($scope === 'custom')
            <div class="form-group ml-4">
                <label for="from">From</label>
            </div>

            <div class="form-group ml-2">
                <input type="date" class="form-control" id="from" name="from" value="{{ $from }}" />
            </div>

            <div class="form-group ml-4">
                <label for="to">To</label>
            </div>

            <div class="form-group ml-2">
                <input type="date" class="form-control" id="to" name="to" value="{{ $to }}" />
            </div>

            <div class="form-group ml-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        @endif
    </form>

    <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#sendReportModal">Send as
        report</button>

    <table class="table table-hover">
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

            @php
                $i = 0;
            @endphp

            @foreach ($tasks as $incident => $details)
                <tr style="cursor: pointer; {!! $i % 2 === 1 ? 'background-color: var(--dark);' : '' !!}" data-toggle="collapse"
                    href=".{{ $details['incident']['incident_number'] }}Task">
                    @if ($details['incident']['incident_number'] !== 'Miscellaneous')
                        <td><a
                                href="https://itsm.asus.com/apps/#/IncidentConsoleDetail/{{ $details['incident']['incident_number'] }}">{{ $details['incident']['incident_number'] }}</a>
                        </td>
                    @else
                        <td>{{ $details['incident']['incident_number'] }}</td>
                    @endif
                    <td>{{ $details['description'] }}</td>
                    <td>{{ $details['hours'] . ':' . $details['minutes'] }}</td>
                </tr>
                @if ($aggregate)
                    @foreach ($details['tasks'] as $task)
                        <tr class="collapse table-secondary {{ $details['incident']['incident_number'] }}Task">
                            <td></td>
                            <td>{{ $task['description'] }}</td>
                            <td>{{ $task->getHours() . ':' . $task->getMinutes() }}</td>
                        </tr>
                    @endforeach
                @endif
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection
