@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('messages.cars') }}</h2>

            @if(auth()->user()->role === 'editor')
                <a href="{{ route('cars.create') }}" class="btn btn-success">{{ __('messages.add_car') }}</a>
            @endif
        </div>

        @if ($cars->count() === 0)
            <div class="alert alert-info">{{ __('messages.no_cars') }}</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.registration_number') }}</th>
                    <th>{{ __('messages.brand') }}</th>
                    <th>{{ __('messages.model') }}</th>
                    <th>{{ __('messages.owner') }}</th>
                    <th style="width: 180px;">{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->reg_number }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->owner->name }} {{ $car->owner->surname }}</td>
                        <td>
                            @if(auth()->user()->role === 'editor')
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary btn-sm">
                                    {{ __('messages.edit') }}
                                </a>

                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('messages.confirm_delete_car') }}')">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">{{ __('messages.view_only') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
