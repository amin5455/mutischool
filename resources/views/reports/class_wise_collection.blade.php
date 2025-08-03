@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Class & Section Wise Fee Report</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Class</th>
                <th>Section</th>
                <th>Total Students</th>
                <th>Paid Students</th>
                <th>Fee Type</th>
                <th>Fee Amount</th>
                <th>Assigned</th>
                <th>Collected</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row['class'] }}</td>
                <td>{{ $row['section'] }}</td>
                <td>{{ $row['total_students'] }}</td>
                <td>{{ $row['paid_students'] }}</td>
                <td>{{ $row['fee_type'] }}</td>
                <td>{{ number_format($row['fee_amount'], 2) }}</td>
    
                <td>{{ number_format($row['collected'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
