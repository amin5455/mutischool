$(document).ready(function () {
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   $('#class_id').on('change', function () {
    let class_id = $(this).val();
    $('#section_id').html('<option value="">Loading...</option>');

    $.get(`/get-sections/${class_id}`, function (sections) {
        let html = '<option value="">Select Section</option>';
        sections.forEach(s => {
            html += `<option value="${s.id}">${s.name}</option>`;
        });
        $('#section_id').html(html);
    });
});

 $('#filterForm').submit(function (e) {
        e.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: '/attendance/load-students',
            type: 'POST',
            data: data,
            success: function (res) {
                $('#attendanceForm').removeClass('d-none');
                $('#studentList').html('');

                // Store values for hidden inputs
                $('#class_id_hidden').val($('#class_id').val());
                $('#section_id_hidden').val($('#section_id').val());
                $('#date_hidden').val($('#date').val());

                // Append student rows
                res.students.forEach(std => {
                    let presentChecked = res.attendance[std.id] === 'present' ? 'checked' : '';
                    let absentChecked = res.attendance[std.id] === 'absent' ? 'checked' : '';
                    let leaveChecked = res.attendance[std.id] === 'leave' ? 'checked' : '';


                    $('#studentList').append(`
                        <tr>
                            <td>${std.name}</td>
                            <td><input type="radio" name="attendances[${std.id}]" value="present" ${presentChecked} required></td>
                            <td><input type="radio" name="attendances[${std.id}]" value="absent" ${absentChecked} required></td>
                            <td><input type="radio" name="attendances[${std.id}]" value="leave" ${leaveChecked} required></td>
                        </tr>
                    `);
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('❌ Error loading students. Make sure all fields are selected.');
            }
        });
    });

    $('#attendanceForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/attendance/store',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                alert(res.success);
            },
            error: function () {
                alert('Error saving attendance.');
            }
        });
    });
});
