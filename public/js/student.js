$(document).ready(function () {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

     fetchStudents();
function fetchStudents() {
    $.get('/students/list', function (students) {
        let html = '';

        students.forEach(function (s) {
            html += `
                <tr id="studentRow${s.id}">
                    <td>${s.name}</td>
                    <td>${s.gender}</td>
                    <td>${s.dob}</td>
                    <td>${s.school_class?.name ?? ''}</td>
                    <td>${s.section?.name ?? ''}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editStudent(${s.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="openDeleteModal(${s.id})">Delete</button>
                    </td>
                </tr>
            `;
        });

        $('#studentTableBody').html(html);
  $('#studentDataTable').DataTable({
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


function fetchStudent() {
    $.get('/students/list', function (students) {
        let html = '';

        students.forEach(function (s) {
            html += `
                <tr id="studentRow${s.id}">
                    <td>${s.name}</td>
                    <td>${s.gender}</td>
                    <td>${s.dob}</td>
                    <td>${s.school_class?.name ?? ''}</td>
                    <td>${s.section?.name ?? ''}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editStudent(${s.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="openDeleteModal(${s.id})">Delete</button>
                    </td>
                </tr>
            `;
        });

        $('#studentTableBody').html(html);
    });
}
        
    $('#studentForm').submit(function (e) {
        e.preventDefault();
        let id = $('#student_id').val();
        let url = id ? `/students/${id}` : '/students';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            success: function (res) {
                alert(res.success);
                $('#studentModal').modal('hide');
                $('#studentModal').on('hidden.bs.modal', function () {
                 $('.modal-backdrop').remove();
                 $('body').removeClass('modal-open').css('overflow', 'auto');
              });
                   fetchStudent();

              },
          error: function (xhr) {
    if (xhr.responseJSON.error) {
        // Custom duplicate student message
        alert(xhr.responseJSON.error);
    } else if (xhr.responseJSON.errors) {
        // Validation errors
        alert(Object.values(xhr.responseJSON.errors).join("\n"));
    } else {
        alert('An unexpected error occurred.');
    }
}
        });
    });
});

function openStudentModal() {
    $('#studentForm')[0].reset();
    $('#student_id').val('');
    $('#studentModal').modal('show');
}

function editStudent(id) {
    $.get(`/students/${id}/edit`, function (data) {
        $('#student_id').val(data.id);
        $('#name').val(data.name);
        $('#gender').val(data.gender);
        $('#dob').val(data.dob);
        $('#school_id').val(data.school_id);
        $('#class_id').val(data.class_id);
        $('#section_id').val(data.section_id);
        $('#studentModal').modal('show');
    });
}

// function deleteStudent(id) {
//     if (confirm('Are you sure to delete this student?')) {
//         $.ajax({
//             url: `/students/${id}`,
//             type: 'DELETE',
//             data: { _token: $('meta[name="csrf-token"]').attr('content') },
//             success: function (res) {
//                 alert(res.success);
//                 $('#studentRow' + id).remove();
//             }
//         });
//     }
// }

function openDeleteModal(id) {
    $('#delete_student_id').val(id);
    $('#deleteStudentModal').modal('show');
}

function confirmDeleteStudent() {
    let id = $('#delete_student_id').val();

    $.ajax({
        url: `/students/${id}`,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $('#deleteStudentModal').modal('hide');
            alert(res.success);
          $('#studentRow' + id).remove();
        },
        error: function (err) {
            alert('Something went wrong while deleting!');
        }
    });


    
}
function loadSectionsByClass(class_id) {
    $('#section_id').html('<option value="">Loading...</option>');

    $.get(`/sections-by-class/${class_id}`, function(sections) {
        let options = '<option value="">Select Section</option>';
        sections.forEach(function(section) {
            options += `<option value="${section.id}">${section.name}</option>`;
        });

        $('#section_id').html(options);
    });
}


