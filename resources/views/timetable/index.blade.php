@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Class Timetable</h4>

    <form id="timetableForm" class="row g-3 mb-4">
        @csrf
        <div class="col-md-3">
            <label>Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Subject</label>
            <select name="subject_id" class="form-control" required>
                <option value="">Select Subject</option>
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Teacher</label>
            <select name="teacher_id" class="form-control" required>
                <option value="">Select Teacher</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Weekday</label>
            <select name="weekday" class="form-control" required>
                <option value="">Select Day</option>
                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)
                    <option value="{{ $day }}">{{ $day }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="col-md-3 mt-4">
            <button class="btn btn-primary mt-2">+ Add Routine</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Day</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="routineTable">
            <!-- AJAX will load -->
        </tbody>
    </table>
</div>


@endsection
