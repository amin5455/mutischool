@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Assign Subject to Teacher</h4>

    <form id="assignForm" class="row g-3 mb-4">
        @csrf
        <div class="col-md-4">
            <label>Class</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Subject</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>Teacher</label>
            <select name="teacher_id" id="teacher_id" class="form-control" required>
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-success">Assign</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="assignmentsTable">
            <!-- Loaded by JS -->
        </tbody>
    </table>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

