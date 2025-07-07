@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
    <div class="container py-4">
        <!-- Welcome Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Welcome, {{ Auth::user()->name }}</h5>
                <p class="card-text">
                    Role: <strong>{{ Auth::user()->role }}</strong>
                </p>
                <p class="card-text">
                    School: <strong>{{ Auth::user()->school->name ?? 'No school assigned' }}</strong>
                </p>
            </div>
        </div>
    </div>
@endsection
