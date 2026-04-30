<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:editor');
    }

    public function store(Request $request, Car $car)
    {
        $request->validate([
            'photos'   => 'required|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        foreach ($request->file('photos') as $file) {
            $path = $file->store('car_photos', 'public');
            $car->photos()->create(['path' => $path]);
        }

        return redirect()->route('cars.edit', $car->id)
            ->with('success', 'Photos uploaded successfully.');
    }

    public function destroy(Car $car, CarPhoto $photo)
    {
        abort_if($photo->car_id !== $car->id, 403);

        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return redirect()->route('cars.edit', $car->id)
            ->with('success', 'Photo deleted.');
    }
}
