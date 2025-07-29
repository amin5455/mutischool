@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Student Fee Records</h2>

    <a href="{{ route('student-fees.create') }}" class="btn btn-primary mb-3">+ Collect Fee</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Fee Type</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Payment Mode</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fees as $key => $fee)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $fee->student->name ?? 'N/A' }}</td>
                    <td>{{ $fee->feeType->title ?? 'N/A' }}</td>
                    <td>{{ number_format($fee->amount_paid, 2) }}</td>
                    <td>{{ $fee->payment_date }}</td>
                    <td>{{ $fee->payment_mode }}</td>
                    <td>{{ $fee->note }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No fee records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
