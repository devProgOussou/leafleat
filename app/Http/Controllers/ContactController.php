<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $contact = new Contact();
        $contact->firstName = $request->input('firstName');
        $contact->lastName = $request->input('lastName');
        $contact->email = $request->input('email');
        $contact->locality = $request->input('locality');
        $contact->population = $request->input('population');
        $contact->phone = $request->input('phone');
        $contact->details = $request->input('details');
        $contact->category = $request->input('category');
        $contact->save();

        $area = new Area();
        $area->area = $request->input('area');
        $area->save();
        return redirect()->route('contact.show');
    }

    public function show()
    {
        $contacts = Contact::with('area')->get();
        $areas = DB::select('SELECT * FROM areas');
        return Inertia::render('Dash/ShowProblem',[
            'contacts' => $contacts,
            'areas' => $areas
        ]);
    }
}
