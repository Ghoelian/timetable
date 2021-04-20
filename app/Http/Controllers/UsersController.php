<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    public function getContacts()
    {
        $contacts = Contact::all();

        return view('user.contacts', ['contacts' => $contacts]);
    }

    public function addContact(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $contact = new Contact();

        $contact->name = $name;
        $contact->email = $email;
        $contact->user_id = \Auth::user()->id;

        $contact->save();

        return back();
    }

    public function toggleContact(Request $request)
    {
        $contact = Contact::query()
            ->where('id', $request->input('contact-id'))
            ->first();

        $contact->enabled = !$contact->enabled;

        $contact->save();

        if ($contact === null)
        {
            return response('Contact not found.', 400);
        }

        return response('Contact updated.', 200);
    }
}
