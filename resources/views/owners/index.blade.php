@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Owners</h2>

            @if(auth()->user()->role === 'editor')
                <a href="{{ route('owners.create') }}" class="btn btn-success">Add new owner</a>
            @endif
        </div>

        @if ($owners->count() === 0)
            <div class="alert alert-info">No owners yet.</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Birth date</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($owners as $owner)
                    <tr>
                        <td>{{ $owner->id }}</td>
                        <td>{{ $owner->name }}</td>
                        <td>{{ $owner->surname }}</td>
                        <td>{{ $owner->birth_date }}</td>
                        <td>{{ $owner->phone }}</td>
                        <td>{{ $owner->email }}</td>
                        <td>
                            @if(auth()->user()->role === 'editor')
                                <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-primary btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('owners.destroy', $owner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this owner?')">
                                        Delete
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">View only</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
