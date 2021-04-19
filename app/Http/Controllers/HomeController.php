<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\TaskLog;
use App\Models\IncidentStatus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $closedStatusId = IncidentStatus::query()
            ->select('id')
            ->where('name', 'Closed')
            ->first()
            ->id;

        $taskLog = TaskLog::query()
            ->where('created_at', '>=', (new DateTime())->format('Y-m-d') . ' 00:00:00')
            ->where('created_at', '<=', (new DateTime())->format('Y-m-d') . ' 23:59:59')
            ->get();

        $incidents = Incident::query()
            ->where('status_id', '<>', $closedStatusId)
            ->orderBy('created_at', 'DESC')
            ->get();

        $totalHours = 0;
        $totalMinutes = 0;

        foreach ($taskLog as $task)
        {
            $totalHours += $task->getHours();
            $totalMinutes += $task->getMinutes();

            if ($totalMinutes >= 60)
            {
                $totalHours++;
                $totalMinutes -= 60;
            }
        }

        return view('home', ['tasks' => $taskLog, 'incidents' => $incidents, 'totalHours' => $totalHours, 'totalMinutes' => $totalMinutes]);
    }

    public function logTime(Request $request)
    {
        $timeRegex = '/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/m';
        $timeSpent = $request->input('time-spent');

        preg_match($timeRegex, $timeSpent, $timeSpent);

        if (count($timeSpent) !== 3)
        {
            return back()->withErrors('Invalid time duration.');
        }

        $timeInMinutes = ((int) $timeSpent[1] * 60) + (int) $timeSpent[2]; // I'm formatting time spent as minutes, instead of seconds, as I don't need it to be that specific

        $log = new TaskLog();

        $log->user_id = \Auth::user()->id;
        $log->incident_id = $request->input('incident');
        $log->description = $request->input('description');
        $log->time_spent = $timeInMinutes;

        $log->save();

        return back();
    }
}
