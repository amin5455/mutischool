@extends('layouts.app')

@section('content')
<div class="container mt-4">
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
            <button type="submit" class="btn btn-primary">+ Assign</button>
        </div>
    </form>

    <table class="table table-bordered" id="assubjectDataTable">
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
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAssSubjectModal" tabindex="-1" aria-labelledby="deleteAssSubjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Subject?
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_asssubject_id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteAssSubject()">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

