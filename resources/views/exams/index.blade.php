@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Exams List</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createExamModal">Add New Exam</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Exam Name</th>
                <th>Start</th>
                <th>End</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                <tr>
                    <td>{{ $exam->name }}</td>
                    <td>{{ $exam->start_date }}</td>
                    <td>{{ $exam->end_date }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#assignSubjectsModal" onclick="setExamId({{ $exam->id }})">Assign Subjects</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Exam Modal --}}
<div class="modal fade" id="createExamModal" tabindex="-1" aria-labelledby="createExamLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('exams.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Exam</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
              <label>Exam Name</label>
              <input type="text" name="name" class="form-control" required>
          </div>
          <div class="form-group mb-3">
              <label>Start Date</label>
              <input type="date" name="start_date" class="form-control" required>
          </div>
          <div class="form-group mb-3">
              <label>End Date</label>
              <input type="date" name="end_date" class="form-control" required>
          </div>
          <input type="hidden" name="school_id" value="{{ auth()->user()->school_id }}">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Assign Subjects Modal --}}
<div class="modal fade" id="assignSubjectsModal">

  <div class="modal-dialog">
    <form id="assignSubjectsForm">
      
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Assign Subjects</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="exam_id" id="exam_id">
          <div class="form-group mb-3">
              <label>Select Class</label>
              <select name="class_id" id="class_id" class="form-control" required>
                  <option value="">-- Select Class --</option>
                  @foreach($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group mb-3">
              <label>Select Subject</label>
              <select name="subject_id" id="subject_id" class="form-control" required>
                  <option value="">-- Select Subject --</option>
                  @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group mb-3">
              <label>Total Marks</label>
              <input type="number" name="total_marks" id= "total_marks" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Assign</button>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection
