    $(document).ready(function () {


$('#assignSubjectsForm').on('submit', function(e) {
    e.preventDefault();
    // let storeExamSubjectUrl = "{{ route('exam.subjects.store') }}";
  $.ajax({
    type: 'POST',
    url: "/exam-subjects",
           data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        exam_id: $('#exam_id').val(),
        class_id: $('#class_id').val(),
        subject_id: $('#subject_id').val(),
        total_marks: $('#total_marks').val()
        
    },
         success: function(response) {
        if (response.success) {
            $('#assignSubjectsModal').modal('hide');

            alert("Subject assigned successfully.");

              $('#assignSubjectsModal').on('hidden.bs.modal', function () {
                 $('.modal-backdrop').remove();
                 $('body').removeClass('modal-open').css('overflow', 'auto');
              });
            // Optionally reset form or reload part of page
        } else {
            alert("Something went wrong!");
        }
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
});
function setExamId(id) {
    $('#exam_id').val(id);
}

