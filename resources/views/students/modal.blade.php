<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="studentForm">
            @csrf
            <input type="hidden" name="id" id="student_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Class</label>
                        <select name="class_id" id="class_id" class="form-control"
                            onchange="loadSectionsByClass(this.value)">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Section</label>
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="">Select Section</option>
                            {{-- Will be dynamically loaded --}}
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this student?
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_student_id">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDeleteStudent()">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>