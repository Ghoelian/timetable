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
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }

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
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }

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
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }

        $statuses = IncidentStatus::query()
            ->where('user_id', \Auth::user()->id)
            ->get();

        return view('incident-statuses', ['statuses' => $statuses]);
    }

    public function postStatus(Request $request)
    {
        if (!\Auth::check())
        {
            return redirect(route('login'));
        }

        $status = new IncidentStatus();

        $status->user_id = \Auth::user()->id;
        $status->name = $request->input('name');
        $status->description = $request->input('description');

        $status->save();

        return back();
    }

    public function updateStatus(Request $request)
    {
        $incidentId = $request->input('incident-id');
        $statusId = $request->input('status-id');

        $incident = Incident::query()
            ->where('user_id', \Auth::user()->id)
            ->where('id', $incidentId)
            ->first();

        $status = IncidentStatus::query()
            ->where('user_id', \Auth::user()->id)
            ->where('id', $statusId)
            ->first();

        if ($incident === null)
        {
            return response('Unknown incident.', 400);
        }

        if ($status === null)
        {
            return response('Unknown incident status.', 400);
        }

        $incident->status_id = $statusId;

        $incident->save();

        return response('Status updated.', 200);
    }

    public function updateDescription(Request $request)
    {
        $incidentId = $request->input('incident-id');

        $incident = Incident::query()
            ->where('user_id', \Auth::user()->id)
            ->where('id', $incidentId)
            ->first();

        if ($incident === null)
        {
            return back()->withErrors('Unknown incident.');
        }

        $incident->description = $request->input('edit-description');

        $incident->save();

        return back();
    }
}
