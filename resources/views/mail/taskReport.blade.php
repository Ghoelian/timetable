<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th {
        text-align: left;
    }

</style>

Hoi @for ($i = 0, $iMax = count($contacts); $i < $iMax; $i++)
    @if ($i === $iMax - 2) {{ $contacts[$i]->name }} en
@else
    {{ $contacts[$i]->name }}, @endif
@endfor
<br /><br />

Hierbij een samenvatting van wat ik vandaag gedaan heb.<br />
<br />

<table>
    <tbody>
        <tr>
            <th>Task</th>
            <th>Description</th>
            <th>Duration</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task['incident']['incident_number'] }}</td>
                <td>{{ $task['description'] }}</td>
                <td>{{ $task['hours'] . ':' . $task['minutes'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br />

Met vriendelijke groet,<br />

Julian Vos
