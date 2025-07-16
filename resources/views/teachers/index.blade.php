@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Teacher Management</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#teacherModal" onclick="openCreateForm()">Add Teacher</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="teacherTableBody"></tbody>
    </table>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="teacherModal" tabindex="-1" aria-labelledby="teacherModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="teacherForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="teacherModalLabel">Add Teacher</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="teacher_id">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea id="address" name="address" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection
