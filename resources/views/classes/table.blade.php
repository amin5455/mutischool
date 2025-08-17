<table id="schoolDataTable" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($classes as $index => $class)
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
        @empty
            <tr>
                <td colspan="2">No classes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="modal fade" id="deleteClassModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
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
        <button id="confirmDeleteClass" class="btn btn-danger">Yes, Delete</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
