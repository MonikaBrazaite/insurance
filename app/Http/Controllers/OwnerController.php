<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:editor')->except(['index']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->type === 'admin') {
            $owners = Owner::all();
        } else {
            $owners = Owner::where('user_id', $user->id)->get();
        }

        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(StoreOwnerRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        Owner::create($data);

        return redirect()->route('owners.index');
    }

    public function edit(Owner $owner)
    {
        $this->authorize('update', $owner);

        return view('owners.edit', compact('owner'));
    }

    public function update(UpdateOwnerRequest $request, Owner $owner)
    {
        $this->authorize('update', $owner);

        $owner->update($request->validated());

        return redirect()->route('owners.index');
    }

    public function destroy(Owner $owner)
    {
        $this->authorize('delete', $owner);

        $owner->delete();
        return redirect()->route('owners.index');
    }
}
