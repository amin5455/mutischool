$(document).ready(function () {
    fetchTimetable();

    $('#timetableForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/timetable/store',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                alert(res.success);
                $('#timetableForm')[0].reset();
                fetchTimetable();
    },


error: function (err) {
    console.log(err); // 🔍 Inspect what Laravel sent

    if (err.responseJSON) {
        // Validation errors
        if (err.status === 422 && err.responseJSON.errors) {
            let messages = '';
            $.each(err.responseJSON.errors, function (key, value) {
                messages += value[0] + '\n';
            });
            alert(messages);
        }
        // Custom errors
        else if (err.responseJSON.error) {
            alert(err.responseJSON.error);
        } else {
            alert('Something went wrong: ' + JSON.stringify(err.responseJSON));
        }
    } else {
        alert('Unexpected error. Check console.');
    }
}

        });
    });
});

function fetchTimetable() {
    $.get('/timetable/list', function (data) {
        let html = '';
        data.forEach(r => {
            html += `
                <tr>
                    <td>${r.class?.name}</td>
                    <td>${r.subject?.name}</td>
                    <td>${r.teacher?.name}</td>
                    <td>${r.weekday}</td>
                    <td>${r.start_time} - ${r.end_time}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteRoutine(${r.id})">Delete</button></td>
                </tr>
            `;
        });
        $('#routineTable').html(html);
    });
}

function deleteRoutine(id) {
    if (confirm('Delete this routine?')) {
        $.ajax({
            url: `/timetable/${id}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                alert(res.success);
                fetchTimetable();
            }
        });
    }
}
