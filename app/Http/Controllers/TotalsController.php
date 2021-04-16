<?php

namespace App\Http\Controllers;

use App\Models\TaskLog;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TotalsController extends Controller
{
    public function __construct()
    {
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }
    }

    public function getTotals(Request $request)
    {
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }

        $aggregate = $request->input('aggregate') ?? true;

        $totalHours = 0;
        $totalMinutes = 0;

        $scope = $request->input('scope') ?? 'day';

        switch ($scope)
        {
            case 'week':
                $min = (new DateTime())->sub(new DateInterval('P' . ((new DateTime())->format('w') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
            case 'month':
                $min = (new DateTime())->sub(new DateInterval('P' . ((new DateTime())->format('j') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                \Log::debug(((new DateTime())->format('m') - 1));
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
            case 'year':
                $min = (new DateTime())->sub(new DateInterval('P' . ((new DateTime())->format('z') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
            default:
                $min = (new DateTime())->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
        }

        $tasks = TaskLog::query()
            ->where('user_id', \Auth::user()->id)
            ->where('created_at', '>=', $min)
            ->where('created_at', '<=', $max)
            ->with('incident')
            ->get();

        $times = collect();

        if ($aggregate)
        {
            foreach ($tasks as $task)
            {
                $incident = $times[$task->incident->incident_number] ?? ['hours' => 0, 'minutes' => 0];

                $taskHours = $incident['hours'];
                $taskMinutes = $incident['minutes'];

                $hours = $task->getHours();
                $minutes = $task->getMinutes();

                $taskHours += $hours;
                $taskMinutes += $minutes;

                $totalHours += $hours;
                $totalMinutes += $minutes;

                if ($taskMinutes >= 60)
                {
                    $taskHours++;
                    $taskMinutes -= 60;
                }

                if ($totalMinutes >= 60)
                {
                    $totalHours++;
                    $totalMinutes -= 60;
                }

                $incidentNumber = $task->incident->incident_number;

                $times[$incidentNumber] = ['incident' => ['incident_number' => $task->incident->incident_number], 'hours' => sprintf('%02d', $taskHours), 'minutes' => sprintf('%02d', $taskMinutes), 'description' => $task->incident->description];
            }
        }
        else
        {
            $times = $tasks;

            foreach ($times as $time)
            {
                $totalHours += $time->getHours();
                $totalMinutes += $time->getMinutes();

                $time->hours = $time->getHours();
                $time->minutes = $time->getMinutes();

                if ($totalMinutes >= 60)
                {
                    $totalHours++;
                    $totalMinutes -= 60;
                }
            }
        }

        return view('totals', ['tasks' => $times, 'totalHours' => sprintf('%02d', $totalHours), 'totalMinutes' => sprintf('%02d', $totalMinutes), 'scope' => $scope, 'aggregate' => $aggregate]);
    }
}
