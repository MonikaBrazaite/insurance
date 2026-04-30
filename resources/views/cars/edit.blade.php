@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">{{ __('messages.edit_car') }}</h2>

        <div class="alert alert-info">
            {{ __('messages.current_owner') }}: {{ $car->owner->name }} {{ $car->owner->surname }}
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Car details form --}}
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">{{ __('messages.registration_number') }}</label>
                <input type="text" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror" value="{{ old('reg_number', $car->reg_number) }}">
                @error('reg_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.brand') }}</label>
                <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $car->brand) }}">
                @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.model') }}</label>
                <input type="text" name="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model', $car->model) }}">
                @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.owner') }}</label>
                <select name="owner_id" class="form-select @error('owner_id') is-invalid @enderror">
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" {{ old('owner_id', $car->owner_id) == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }} {{ $owner->surname }}
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
        </form>

        {{-- Photos section --}}
        <hr class="my-4">
        <h4>Photos</h4>

        @if ($car->photos->count() > 0)
            <div class="row g-3 mb-4">
                @foreach ($car->photos as $photo)
                    <div class="col-6 col-md-3 text-center">
                        <img src="{{ Storage::url($photo->path) }}"
                             class="img-fluid rounded shadow-sm mb-2"
                             style="max-height: 180px; object-fit: cover; width: 100%;">
                        <form action="{{ route('car_photos.destroy', [$car->id, $photo->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this photo?')">
                                &times; Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">No photos yet.</p>
        @endif

        {{-- Upload new photos --}}
        <form action="{{ route('car_photos.store', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Upload new photos</label>
                <input type="file" name="photos[]" class="form-control" multiple accept="image/*">
                <div class="form-text">You can select multiple photos at once. JPG, PNG, WEBP — max 4MB each.</div>
            </div>
            <button type="submit" class="btn btn-success">Upload Photos</button>
        </form>
    </div>
@endsection
