@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">{{ __('messages.edit_owner') }}</h2>

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
                <label class="form-label">{{ __('messages.name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $owner->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.surname') }}</label>
                <input type="text" name="surname" class="form-control" value="{{ old('surname', $owner->surname) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $owner->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.email') }}</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $owner->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.birth_date') }}</label>
                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $owner->birth_date) }}">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
            <a href="{{ route('owners.index') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
        </form>

        <hr class="my-4">

        <h4>{{ __('messages.cars_of_owner') }}</h4>

        @if($owner->cars->count() > 0)
            <table class="table table-bordered mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.registration_number') }}</th>
                    <th>{{ __('messages.brand') }}</th>
                    <th>{{ __('messages.model') }}</th>
                    <th>{{ __('messages.owner') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($owner->cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->reg_number }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->owner->name }} {{ $car->owner->surname }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info mt-3">
                {{ __('messages.owner_has_no_cars') }}
            </div>
        @endif
    </div>
@endsection
