<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:editor')->except(['index']);
    }

    // show all owners
    public function index()
    {
        $owners = Owner::all();
        return view('owners.index', compact('owners'));
    }

    // show create form
    public function create()
    {
        return view('owners.create');
    }

    // store new owner
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
        ]);

        Owner::create($request->all());

        return redirect()->route('owners.index');
    }

    // show edit form
    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    // update owner
    public function update(Request $request, Owner $owner)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'birth_date' => 'nullable|date',
        ]);

        $owner->update($request->all());

        return redirect()->route('owners.index');
    }

    // delete owner
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('owners.index');
    }
}
