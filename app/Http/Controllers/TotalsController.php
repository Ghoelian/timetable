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

        $totalHours = 0;
        $totalMinutes = 0;

        $scope = $request->input('scope') ?? 'day';

        switch ($scope)
        {
            case 'week':
                $min = (new DateTime())->sub(new DateInterval('P7D'))->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
            case 'month':
                $min = (new DateTime())->sub(new DateInterval('P1M'))->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->format('Y-m-d') . ' 23:59:59';
                break;
            case 'year':
                $min = (new DateTime())->sub(new DateInterval('P1Y'))->format('Y-m-d') . ' 00:00:00';
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

        $times = [];

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

            $times[$task->incident->incident_number] = ['hours' => $taskHours, 'minutes' => $taskMinutes];
        }

        return view('totals', ['tasks' => $times, 'totalHours' => $totalHours, 'totalMinutes' => $totalMinutes, 'scope' => $scope]);
    }
}
