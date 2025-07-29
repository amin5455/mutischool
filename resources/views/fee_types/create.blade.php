@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Fee Type</h2>
    
    <form method="POST" action="{{ route('fee-types.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Fee Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="amount" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-success">Add Fee Type</button>
        <a href="{{ route('fee-types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
