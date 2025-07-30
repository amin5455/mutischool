@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Class-wise Fee Collection Report</h2>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Class</th>
                <th>Total Students</th>
                <th>Total Collected</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['class_name'] }}</td>
                    <td>{{ $row['student_count'] }}</td>
                    <td>Rs. {{ number_format($row['total_collected'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
