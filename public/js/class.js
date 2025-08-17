$(document).ready(function () {
    $('#classForm').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr('action') || '/classes',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                
                    $('#classModal').modal('hide');
                    $('#classForm')[0].reset();
                     location.reload(); 


                } else {
                    alert('Failed to save class');
                }
            },
           error: function(xhr) {
    let errors = xhr.responseJSON.errors;
    if (errors && errors.name) {
        $('#classNameError').text(errors.name[0]);
    }
}
        });
    });





    // Fill modal with current data
    $('.edit-class-btn').on('click', function () {
        let classId = $(this).data('id');
        let className = $(this).data('name');

        $('#editClassId').val(classId);
        $('#editClassName').val(className);

        $('#editClassModal').modal('show');
    });

    // Handle update via AJAX
    $('#updateClassBtn').on('click', function () {
        let classId = $('#editClassId').val();
        let className = $('#editClassName').val();

        $.ajax({
            url: `/classes/${classId}`,
            method: 'PUT',
            data: {
                name: className,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
     success: function (response) {
    if (response.success) {
        $('#editClassModal').modal('hide');
        $('#classForm')[0].reset();
        alert(response.message);
         location.reload(); 

    } else {
        alert('Failed to save class');
    }
},
            error: function (xhr) {
                let err = xhr.responseJSON.errors;
                if (err && err.name) {
                    $('#editClassNameError').text(err.name[0]);
                }
            }
        });
    });




    // Delete button clicked
    $('.delete-class-btn').on('click', function () {
        let classId = $(this).data('id');
        let className = $(this).data('name');

        $('#deleteClassId').val(classId);
        $('#deleteClassName').text(className);

        $('#deleteClassModal').modal('show');
    });

    // Confirm delete
    $('#confirmDeleteClass').on('click', function () {
        let classId = $('#deleteClassId').val();
        $(this).prop('disabled', true);
        $.ajax({
            url: `/classes/${classId}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (res) {
                $('#deleteClassModal').modal('hide');
                alert(res.success);
                location.reload(); // or re-fetch classes table via AJAX
            },
            error: function (err) {
                alert('Something went wrong.');
            }
        });
    });


});
