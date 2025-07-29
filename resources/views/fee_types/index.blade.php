@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Fee Types</h2>
    <a href="{{ route('fee-types.create') }}" class="btn btn-primary mb-3">+ Add Fee Type</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($feeTypes as $key => $fee)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $fee->title }}</td>
                    <td>{{ number_format($fee->amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Fee Types Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
