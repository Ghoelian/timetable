@extends('layouts.head')

@section('title', 'Totals')

@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'day' ? 'active' : '' }}" href="{{ route('totals', ['scope' => 'day']) }}">Day</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'week' ? 'active' : '' }}" href="{{ route('totals', ['scope' => 'week']) }}">Week</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'month' ? 'active' : '' }}" href="{{ route('totals', ['scope' => 'month']) }}">Month</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $scope === 'year' ? 'active' : '' }}" href="{{ route('totals', ['scope' => 'year']) }}">Year</a>
        </li>
    </ul>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">Incident Number</th>
                <th scope="col">Description</th>
                <th scope="col">Time Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $incident => $time)
                <tr>
                    <td>{{ $incident }}</td>
                    <td>{{ $incident->description }}</td>
                    <td>{{ sprintf("%02d", $time['hours']) . ':' . sprintf("%02d", $time['minutes']) }}</td>
                </tr>
            @endforeach
            <tr class="table-secondary">
                <th scope="row">Total</th>
                <th scope="row">{{ sprintf("%02d", $totalHours) . ':' . sprintf("%02d", $totalMinutes) }}</th>
            </tr>
        </tbody>
    </table>
@endsection
