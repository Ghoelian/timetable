@extends('layouts.head')

@section('title', 'Totals')

@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('totals', ['scope' => 'day']) }}">Day</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('totals', ['scope' => 'week']) }}">Week</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('totals', ['scope' => 'month']) }}">Month</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('totals', ['scope' => 'year']) }}">Year</a>
        </li>
    </ul>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Incident Number</th>
                <th scope="col">Time Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $incident => $time)
                <tr>
                    <td>{{ $incident }}</td>
                    <td>{{ sprintf("%02d", $time['hours']) . ':' . sprintf("%02d", $time['minutes']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
