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
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($classes as $index => $class)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $class->name }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No classes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="classForm">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="classModalLabel">Add New Class</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Class Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
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

    {{-- AJAX Script --}}
    <script>
        document.getElementById('classForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            fetch("{{ route('classes.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('classModal'));
                    modal.hide();

                    // Reset form
                    document.getElementById('classForm').reset();

                    // Refresh table
                    document.getElementById('classesTable').innerHTML = data.table;
                } else {
                    alert('Error saving class');
                }
            })
            .catch(err => console.error(err));
        });
    </script>

@endsection

