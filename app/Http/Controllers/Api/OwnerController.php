<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        return response()->json(Owner::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        $owner = Owner::create($validated);

        return response()->json($owner, 201);
    }

    public function show(Owner $owner)
    {
        return response()->json($owner);
    }

    public function update(Request $request, Owner $owner)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        $owner->update($validated);

        return response()->json($owner);
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return response()->json(null, 204);
    }
}
