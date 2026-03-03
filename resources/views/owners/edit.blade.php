@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Edit Owner</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('owners.update', $owner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $owner->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input type="text" name="surname" class="form-control" value="{{ old('surname', $owner->surname) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $owner->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $owner->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Birth date</label>
                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $owner->birth_date) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('owners.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
