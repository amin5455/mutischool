@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Subject Management</h4>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#subjectModal" onclick="openSubjectModal()">Add Subject</button>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Class</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subjectTableBody">
                <!-- Fetched by AJAX -->
            </tbody>
        </table>
    </div>
</div>

<!-- Subject Modal -->
<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="subjectForm">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="subjectModalLabel">Add Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="subject_id" name="subject_id">
            <div class="mb-3">
                <label for="class_id">Class</label>
                <select name="class_id" id="class_id" class="form-control" required>
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name">Subject Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

