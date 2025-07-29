@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Assign Fees to Classes</h2>

    <form method="POST" action="{{ route('fee-assignments.store') }}">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label for="class_id" class="form-label">Class</label>
                <select name="class_id" class="form-select" required>
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label for="fee_type_id" class="form-label">Fee Type</label>
                <select name="fee_type_id" class="form-select" required>
                    <option value="">Select Fee</option>
                    @foreach ($feeTypes as $fee)
                        <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Assign Fee</button>
    </form>

    <hr class="my-4">

    <h4>Already Assigned Fees</h4>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Class</th>
                <th>Fee Type</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignedFees as $key => $assign)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $assign->class->name ?? 'N/A' }}</td>
                    <td>{{ $assign->feeType->title ?? 'N/A' }}</td>
                    <td>{{ $assign->due_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
