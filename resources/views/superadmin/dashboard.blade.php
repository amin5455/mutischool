@extends('superadmin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Super Admin - Manage Schools</h2>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>School Name</th>
                <th>Status</th>
                <th>Toggle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schools as $school)
                <tr>
                    <td>{{ $school->name }}</td>
                    <td>
                        <span class="badge bg-{{ $school->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($school->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('schools.toggle', $school) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary" type="submit">
                                {{ $school->status == 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
