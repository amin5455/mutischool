@extends('layouts.app') <!-- If you're using a common layout -->

@section('content')
    <div class="container mt-4">
        <h4 class="mb-3">Manage Sections</h4>

        <!-- Button to trigger modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#sectionModal">
            + Add Section
        </button>

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
    <div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="sectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="sectionForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sectionModalLabel">Add Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Section Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
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

    <!-- Include JS -->
    <script src="{{ asset('js/section.js') }}"></script>

@endsection
