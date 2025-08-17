@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Manage Classes</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#classModal">
                + Add New Class
            </button>
        </div>

        <!-- Classes Table -->
        <div id="classesTable">
            <table id="schoolDataTable" class="table table-bordered">

    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($classes as $index => $class)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $class->name }}</td>
                <td>
                <button class="btn btn-sm btn-secondary edit-class-btn" 
                  data-id="{{ $class->id }}" 
                  data-name="{{ $class->name }}">
                  Edit
                </button>
                <button class="btn btn-sm btn-danger delete-class-btn"
                 data-id="{{ $class->id }}"
                 data-name="{{ $class->name }}">
                  Delete
                  </button>

                </td>
                

            </tr>
        @endforeach
    </tbody>
</table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="classForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="classModalLabel">Add New Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Class Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <small id="classNameError" class="text-danger"></small>
                            </div>
                            <input type="hidden" name="school_id" value="{{ Auth::user()->school_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="modal fade" id="editClassModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
         <form id="classForm">
                    @csrf
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editClassId">
        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" id="editClassName" class="form-control">
            <small id="editClassNameError" class="text-danger"></small>
        </div>
</form>
      </div>
      <div class="modal-footer">
        <button id="updateClassBtn" class="btn btn-primary">Update</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="deleteClassModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the class <strong id="deleteClassName"></strong>?</p>
        <input type="hidden" id="deleteClassId">
      </div>
      <div class="modal-footer">
        <button id="confirmDeleteClass" class="btn btn-danger">Delete</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>



@endsection

