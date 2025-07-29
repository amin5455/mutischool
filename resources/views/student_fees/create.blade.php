@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Collect Student Fee</h2>

    <form method="POST" action="{{ route('student-fees.store') }}">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" class="form-select" required>
                <option value="">Select Student</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fee_type_id" class="form-label">Fee Type</label>
            <select name="fee_type_id" class="form-select" required>
                <option value="">Select Fee Type</option>
                @foreach ($feeTypes as $fee)
                    <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount_paid" class="form-label">Amount Paid</label>
            <input type="number" class="form-control" name="amount_paid" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" name="payment_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_mode" class="form-label">Payment Mode</label>
            <input type="text" name="payment_mode" class="form-control">
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note (optional)</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Payment</button>
    </form>
</div>
@endsection
