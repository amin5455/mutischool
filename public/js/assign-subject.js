$(document).ready(function () {
    loadAssignments();

    $('#assignForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/assign-subjects/store",
            type: "POST",
            data: $(this).serialize(),
            success: function (res) {
                alert(res.success);
                $('#assignForm')[0].reset();
                loadAssignment();
            },
             error: function(xhr) {
        if (xhr.responseJSON.error) {
            alert(xhr.responseJSON.error); // duplicate assignment
        } else if (xhr.responseJSON.errors) {
            alert(Object.values(xhr.responseJSON.errors).join("\n")); // validation errors
        }
    }
        });
    });
});

function loadAssignments() {
    $.get('/assign-subjects/list', function (data) {
        let html = '';
        data.forEach(row => {
            html += `
                <tr>
                    <td>${row.class?.name ?? ''}</td>
                    <td>${row.subject?.name ?? ''}</td>
                    <td>${row.teacher?.name ?? ''}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteAssSubject(${row.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
        $('#assignmentsTable').html(html);

         $('#assubjectDataTable').DataTable({
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

function loadAssignment() {
    $.get('/assign-subjects/list', function (data) {
        let html = '';
        data.forEach(row => {
            html += `
                <tr>
                    <td>${row.class?.name ?? ''}</td>
                    <td>${row.subject?.name ?? ''}</td>
                    <td>${row.teacher?.name ?? ''}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteAssSubject(${row.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
        $('#assignmentsTable').html(html);

      
    });
}

function deleteAssSubject(id) {
    $('#delete_asssubject_id').val(id);
    $('#deleteAssSubjectModal').modal('show');
}

function confirmDeleteAssSubject() {
        let id = $('#delete_asssubject_id').val();

        $.ajax({
            url: `/assign-subjects/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                alert(res.success);
                $('#deleteAssSubjectModal').modal('hide');
                loadAssignment();
            }
        });
}
