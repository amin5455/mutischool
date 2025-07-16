$(document).ready(function () {
    fetchSubjects();

    $('#subjectForm').on('submit', function (e) {
        e.preventDefault();
        let id = $('#subject_id').val();
        let url = id ? `/subjects/${id}` : '/subjects';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                class_id: $('#class_id').val(),
                name: $('#name').val(),
            },
            success: function (res) {
                $('#subjectModal').modal('hide');
                $('#subjectForm')[0].reset();
                fetchSubjects();
                alert(res.success);
            },
            error: function (err) {
                alert('Error saving subject');
            }
        });
    });
});

function fetchSubjects() {
    $.get('/get-subjects', function (subjects) {
        let html = '';
        subjects.forEach(function (s) {
            html += `
                <tr>
                    <td>${s.name}</td>
                    <td>${s.school_class?.name ?? ''}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editSubject(${s.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteSubject(${s.id})">Delete</button>
                    </td>
                </tr>`;
        });
        $('#subjectTableBody').html(html);
    });
}

function openSubjectModal() {
    $('#subjectForm')[0].reset();
    $('#subject_id').val('');
    $('#subjectModalLabel').text('Add Subject');
}

function editSubject(id) {
    $.get(`/subjects/${id}/edit`, function (data) {
        $('#subject_id').val(data.id);
        $('#class_id').val(data.class_id);
        $('#name').val(data.name);
        $('#subjectModalLabel').text('Edit Subject');
        $('#subjectModal').modal('show');
    });
}

function deleteSubject(id) {
    if (confirm('Are you sure you want to delete this subject?')) {
        $.ajax({
            url: `/subjects/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                alert(res.success);
                fetchSubjects();
            }
        });
    }
}
