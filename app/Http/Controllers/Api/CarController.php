<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return response()->json(Car::with('owner')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reg_number' => 'required|string|max:255',
            'brand'      => 'required|string|max:255',
            'model'      => 'required|string|max:255',
            'owner_id'   => 'required|exists:owners,id',
        ]);

        $car = Car::create($validated);

        return response()->json($car, 201);
    }

    public function show(Car $car)
    {
        return response()->json($car->load('owner'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'reg_number' => 'required|string|max:255',
            'brand'      => 'required|string|max:255',
            'model'      => 'required|string|max:255',
            'owner_id'   => 'required|exists:owners,id',
        ]);

        $car->update($validated);

        return response()->json($car);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(null, 204);
    }
}
