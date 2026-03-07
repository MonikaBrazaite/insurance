@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Edit Car</h2>

        <div class="alert alert-info">
            Current owner: {{ $car->owner->name }} {{ $car->owner->surname }}
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Registration number</label>
                <input type="text" name="reg_number" class="form-control" value="{{ old('reg_number', $car->reg_number) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Model</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Owner</label>
                <select name="owner_id" class="form-select">
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id', $car->owner_id) == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }} {{ $owner->surname }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
