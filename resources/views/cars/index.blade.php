@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Cars</h2>
            <a href="{{ route('cars.create') }}" class="btn btn-success">Add new car</a>
        </div>

        @if ($cars->count() === 0)
            <div class="alert alert-info">No cars yet.</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Reg. number</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Owner</th>
                    <th style="width: 180px;">Actions</th>
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
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this car?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
