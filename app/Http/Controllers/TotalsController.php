<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\TaskLog;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mail;

class TotalsController extends Controller
{
    public function getTotals(Request $request)
    {
        $aggregate = $request->input('aggregate') ?? false;

        $totalHours = 0;
        $totalMinutes = 0;

        $scope = $request->input('scope') ?? 'day';

        $today = new DateTime();

        $from = $request->input('from');
        $to = $request->input('to');

        switch ($scope)
        {
            // Some whacky calculations to get the first day of the current week,
            case 'week':
                $min = (new DateTime())->setISODate($today->format('Y'), $today->format('W'), 0)->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            // the first day of the previous week,
            case 'last_week':
                $min = (new DateTime())->setISODate($today->format('Y'), $today->format('W') - 1, 0)->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->setISODate($today->format('Y'), $today->format('W') - 1, 6)->format('Y-m-d') . ' 23:59:59';
                break;
            // the first day of the current month,
            case 'month':
                $min = (new DateTime())->sub(new DateInterval('P' . ($today->format('j') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            // and the first day of the current year
            case 'year':
                $min = (new DateTime())->sub(new DateInterval('P' . ($today->format('z') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            case 'all_time':
                $min = '1000-01-01 00:00:00';
                $max = '9999-12-31 23:59:59';
                break;
            case 'custom':
                $min = $from . ' 00:00:00';
                $max = $to . ' 23:59:59';
                break;
            default:
                $min = $today->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
        }

        $tasks = TaskLog::query()
            ->where('created_at', '>=', $min)
            ->where('created_at', '<=', $max)
            ->orderBy('created_at', 'ASC')
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

                $incidentTasks = $tasks->where('incident_id', $task->incident->id);

                $times[$incidentNumber] = ['incident' => ['incident_number' => $task->incident->incident_number], 'hours' => sprintf('%02d', $taskHours), 'minutes' => sprintf('%02d', $taskMinutes), 'description' => $task->incident->description, 'tasks' => $incidentTasks];
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

        return view('totals', ['tasks' => $times, 'totalHours' => sprintf('%02d', $totalHours), 'totalMinutes' => sprintf('%02d', $totalMinutes), 'scope' => $scope, 'aggregate' => $aggregate, 'from' => $from, 'to' => $to]);
    }

    public function sendTotals(Request $request)
    {
        $scope = $request->input('scope') ?? 'day';
        $aggregate = $request->input('aggregate') ?? false;

        $contacts = Contact::query()
            ->where('enabled', true)
            ->get();

        $today = new DateTime();

        switch ($scope)
        {
            case 'week':
                $min = (new DateTime())->setISODate($today->format('Y'), $today->format('W'), 0)->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            case 'last_week':
                $min = (new DateTime())->setISODate($today->format('Y'), $today->format('W') - 1, 0)->format('Y-m-d') . ' 00:00:00';
                $max = (new DateTime())->setISODate($today->format('Y'), $today->format('W') - 1, 6)->format('Y-m-d') . ' 23:59:59';
                break;
            case 'month':
                $min = (new DateTime())->sub(new DateInterval('P' . ($today->format('j') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            case 'year':
                $min = (new DateTime())->sub(new DateInterval('P' . ($today->format('z') - 1) . 'D'))->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
            default:
                $min = $today->format('Y-m-d') . ' 00:00:00';
                $max = $today->format('Y-m-d') . ' 23:59:59';
                break;
        }

        $tasks = TaskLog::query()
            ->where('created_at', '>=', $min)
            ->where('created_at', '<=', $max)
            ->orderBy('created_at', 'ASC')
            ->with('incident')
            ->get();

        $times = collect();

        if ($request->input('aggregate') ?? true)
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

                if ($taskMinutes >= 60)
                {
                    $taskHours++;
                    $taskMinutes -= 60;
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
                $time->hours = $time->getHours();
                $time->minutes = $time->getMinutes();
            }
        }

        $data = ['tasks' => $times, 'contacts' => $contacts];

        $recepients = [];

        foreach ($contacts as $contact)
        {
            array_push($recepients, $contact->email);
        }

        Mail::send('mail.taskReport', $data, function ($message) use ($today, $recepients)
        {
            $message
                ->to($recepients)
                ->bcc('julian_vos@asus.com')
                ->subject('Dagoverzicht Julian ' . $today->format('d/m/y'))
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        return back();
    }
}
