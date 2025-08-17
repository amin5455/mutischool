@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Student Result List</h3>

    <form method="GET" action="{{ route('results.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Class:</label>
            <select name="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Exam:</label>
            <select name="exam_id" class="form-control" required>
                <option value="">Select Exam</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                        {{ $exam->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @if(count($students) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Class</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->schoolclass->name ?? '-' }}</td>
                <td>{{ $student->section->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('result.show', [$student->id, request('exam_id')]) }}" class="btn btn-sm btn-success">View Result</a>
                    <a href="{{ route('result.pdf', [$student->id, request('exam_id')]) }}" class="btn btn-sm btn-info disabled">Download PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
