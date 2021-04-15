<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\IncidentStatus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IncidentsController extends Controller
{
    public function __construct()
    {
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }
    }

    public function getIncidents()
    {
        $incidents = Incident::query()
            ->where('user_id', \Auth::user()->id)
            ->get();

        $statuses = IncidentStatus::query()
            ->where('user_id', \Auth::user()->id)
            ->get();

        return view('incidents', ['incidents' => $incidents, 'statuses' => $statuses]);
    }

    public function postIncident(Request $request)
    {
        $incident = new Incident();

        $incident->user_id = \Auth::user()->id;
        $incident->incident_number = $request->input('incident-number');
        $incident->status_id = $request->input('status');
        $incident->description = $request->input('description');

        $incident->save();

        return back();
    }

    public function getStatuses()
    {
        $statuses = IncidentStatus::query()
            ->where('user_id', \Auth::user()->id)
            ->get();

        return view('incident-statuses', ['statuses' => $statuses]);
    }

    public function postStatus(Request $request)
    {
        $status = new IncidentStatus();

        $status->user_id = \Auth::user()->id;
        $status->name = $request->input('name');
        $status->description = $request->input('description');

        $status->save();

        return back();
    }
}
