<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;

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
    public function store(StoreOwnerRequest $request)
    {
        Owner::create($request->validated());

        return redirect()->route('owners.index');
    }

    // show edit form
    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    // update owner
    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $owner->update($request->validated());

        return redirect()->route('owners.index');
    }

    // delete owner
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('owners.index');
    }
}
