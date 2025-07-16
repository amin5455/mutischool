$(document).ready(function () {

    // ✅ Set CSRF Token globally for all AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // ✅ Fetch teachers on page load
    fetchTeachers();

    // ✅ Handle Add/Edit Form Submit
    $('#teacherForm').on('submit', function (e) {
        e.preventDefault();
        let id = $('#teacher_id').val();
        let url = id ? `/teachers/update/${id}` : `/teachers/store`;
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),

            success: function (res) {
                $('#teacherModal').modal('hide');
                $('#teacherForm')[0].reset();
                fetchTeachers();
            },
             error: function (xhr) {
                alert(Object.values(xhr.responseJSON.errors).join("\n"));
            }
        });
    });
});

// ✅ Fetch and display teachers
function fetchTeachers() {
    $.get('/teachers/fetch', function (res) {
        let rows = '';
        res.teachers.forEach((teacher, index) => {
            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${teacher.name}</td>
                    <td>${teacher.phone ?? '-'}</td>
                    <td>${teacher.address ?? '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="editTeacher(${teacher.id}, '${teacher.name}', '${teacher.phone ?? ''}', '${teacher.address ?? ''}')">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTeacher(${teacher.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
        $('#teacherTableBody').html(rows);
    });
}

// ✅ Open modal in create mode
function openCreateForm() {
    $('#teacherForm')[0].reset();
    $('#teacher_id').val('');
    $('#teacherModalLabel').text('Add Teacher');
}

// ✅ Populate and show modal in edit mode
function editTeacher(id, name, phone, address) {
    $('#teacher_id').val(id);
    $('#name').val(name);
    $('#phone').val(phone);
    $('#address').val(address);
    $('#teacherModalLabel').text('Edit Teacher');
    $('#teacherModal').modal('show');
}

// ✅ Delete teacher
function deleteTeacher(id) {
    alert(id)
    if (confirm('Are you sure to delete this teacher?')) {
        $.ajax({
            url: `/teachers/delete/${id}`,
            method: 'DELETE',
            data: {},
            success: function (res) {
                fetchTeachers();
            }
        });
    }
}