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
                $('#teacherModal').on('hidden.bs.modal', function () {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css('overflow', 'auto');
              });
                fetchTeacher();


            },
             error: function (xhr) {
    if (xhr.responseJSON.error) {
        // Custom duplicate teacher message
        alert(xhr.responseJSON.error);
    } else if (xhr.responseJSON.errors) {
        // Laravel validation errors
        alert(Object.values(xhr.responseJSON.errors).join("\n"));
    } else {
        alert('An unexpected error occurred.');
    }
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
          $('#teacherDataTable').DataTable({
      // Optional settings:
      responsive: true,
      pageLength: 10,
      language: {
        searchPlaceholder: "Search classes...",
        search: "",
      }
    });
    });
}

function fetchTeacher() {
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
    $('#delete_teacher_id').val(id);
    $('#deleteTeacherModal').modal('show');
}

function confirmDeleteTeacher() {
    let id = $('#delete_teacher_id').val();
  $.ajax({
            url: `/teachers/delete/${id}`,
            method: 'DELETE',
            data: {},
            success: function (res) {
            $('#deleteTeacherModal').modal('hide');
                fetchTeacher();
            }
        });
}
