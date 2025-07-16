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
                loadAssignments();
            },
            error: function (err) {
                alert("Failed to assign. Check inputs.");
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
                        <button class="btn btn-danger btn-sm" onclick="deleteAssignment(${row.id})">Delete</button>
                    </td>
                </tr>
            `;
        });
        $('#assignmentsTable').html(html);
    });
}

function deleteAssignment(id) {
    if (confirm('Are you sure to delete this assignment?')) {
        $.ajax({
            url: `/assign-subjects/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                alert(res.success);
                loadAssignments();
            }
        });
    }
}
