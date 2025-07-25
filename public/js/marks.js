
$('#get-students').on('click', function () {
    $.ajax({
        url: '/marks-entry/fetch-students',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),

            exam_id: $('#exam_id').val(),
            class_id: $('#class_id').val(),
            section_id: $('#section_id').val(),
            subject_id: $('#subject_id').val(),
        },
        success: function (response) {
                // if (response.success) {
                    
            $('#students-marks-table').html(response.html);
                  // Optionally reset form or reload part of page
        // } else {
        //     alert("Something went wrong!");
        // }
    },
    error: function(xhr, status, error) {
        // Display Laravel error message
        if (xhr.responseJSON && xhr.responseJSON.message) {
            alert("Error: " + xhr.responseJSON.message);
        } else {
            alert("An unexpected error occurred.");
        }
    }
        
    });
});

$('#marksForm').on('submit', function (e) {
    e.preventDefault();

    const data = [];
    $('.student-mark').each(function () {
        data.push({
            student_id: $(this).data('id'),
            marks_obtained: $(this).val(),
            exam_id: $('#exam_id').val(),
            class_id: $('#class_id').val(),
            section_id: $('#section_id').val(),
            subject_id: $('#subject_id').val()
        });
    });

    $.ajax({
        url: "/marks-store",
        method: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),

            marks: data
        },
        success: function (res) {
            alert('Marks Saved Successfully!');
        },
          error: function(xhr, status, error) {
        // Display Laravel error message
        if (xhr.responseJSON && xhr.responseJSON.message) {
            alert("Error: " + xhr.responseJSON.message);
        } else {
            alert("An unexpected error occurred.");
        }
    }
        
    
    });
});