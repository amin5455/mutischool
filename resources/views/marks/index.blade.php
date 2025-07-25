@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Enter Marks</h2>

    <div class="row mb-3">
        <div class="col-md-3">
            <label>Exam</label>
            <select id="exam_id" class="form-control">
                <option value="">-- Select --</option>
                @foreach($exams as $exam)
                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Class</label>
            <select id="class_id" class="form-control">
                <option value="">-- Select --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Section</label>
            <select id="section_id" class="form-control">
                <option value="">-- Select --</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Subject</label>
            <select id="subject_id" class="form-control">
                <option value="">-- Select --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button class="btn btn-primary mb-3" id="get-students">Get Students</button>

    <form id="marksForm">
        @csrf
        <div id="students-marks-table">
            
        </div>
        <button type="submit" class="btn btn-success mt-3">Save Marks</button>
    </form>
</div>
@endsection

