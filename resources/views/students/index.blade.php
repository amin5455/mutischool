@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Student Management</h4>
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#studentModal" onclick="openStudentModal()">+ Add Student</button>
</div>
    <table class="table table-bordered" id="studentDataTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Class</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
     <tbody id="studentTableBody">
    {{-- Filled by AJAX --}}
</tbody>

    </table>
</div>

@include('students.modal')
@endsection
