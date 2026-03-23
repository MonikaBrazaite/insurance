<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Owner;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:editor')->except(['index']);
    }

    public function index()
    {
        $cars = Car::with('owner')->get();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $owners = Owner::all();
        return view('cars.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reg_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required'
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index');
    }

    public function edit(Car $car)
    {
        $owners = Owner::all();
        return view('cars.edit', compact('car', 'owners'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'reg_number' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'owner_id' => 'required'
        ]);

        $car->update($request->all());

        return redirect()->route('cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
