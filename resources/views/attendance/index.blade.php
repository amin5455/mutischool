@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Mark Student Attendance</h4>

    <form id="filterForm" class="row g-3">
        <div class="col-md-3">
            <label>Class</label>
            <select name="class_id" id="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Section</label>
            <select name="section_id" id="section_id" class="form-control" required>
                <option value="">Select Section</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Date</label>
            <input type="date" name="date" id="date" class="form-control" required value="{{ date('Y-m-d') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Load Students</button>
        </div>
    </form>

    <form id="attendanceForm" class="mt-4 d-none">
        @csrf
        <input type="hidden" name="class_id" id="class_id_hidden">
        <input type="hidden" name="section_id" id="section_id_hidden">
        <input type="hidden" name="date" id="date_hidden">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                </tr>
            </thead>
            <tbody id="studentList">
                <!-- Loaded by AJAX -->
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save Attendance</button>
    </form>
</div>

@endsection

