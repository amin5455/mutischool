@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Manage Sections</h4>

        <!-- Button to trigger modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sectionModal">
            + Add Section
        </button>
</div>
        <!-- Section Table -->
        <div class="table-responsive">
            <table class="table table-bordered" id="sectionTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Section Name</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sectionModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="sectionForm">
                @csrf
                <div class="modal-content">
                    <input type="hidden" name="school_id" value="{{ Auth::user()->school_id }}">
                    <input type="hidden" id="section_id" name="section_id">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="sectionModalLabel">Add Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Section Name</label>
                            <input type="text" class="form-control" id="section_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="class_id" class="form-label">Select Class</label>
                            <select name="school_class_id" id="school_class_id" class="form-select" required>
                                <option value="">-- Select Class --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
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


    <!-- Delete Section Modal -->
<div class="modal fade" id="deleteSectionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteSectionModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this section?
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_section_id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteSection">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection
