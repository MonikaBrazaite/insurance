@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('messages.owners') }}</h2>

            @if(auth()->user()->role === 'editor')
                <a href="{{ route('owners.create') }}" class="btn btn-success">
                    {{ __('messages.add_owner') }}
                </a>
            @endif
        </div>

        @if ($owners->count() === 0)
            <div class="alert alert-info">{{ __('messages.no_owners') }}</div>
        @else
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.surname') }}</th>
                    <th>{{ __('messages.birth_date') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th style="width: 180px;">{{ __('messages.actions') }}</th>
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
                                    {{ __('messages.edit') }}
                                </a>

                                <form action="{{ route('owners.destroy', $owner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('messages.confirm_delete_owner') }}')">
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
