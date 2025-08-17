$(document).ready(function () {
    fetchSections();

    function fetchSections() {
        $.get('/sections/list', function (data) {
            let rows = '';
            $.each(data, function (index, section) {
                rows += `
                    <tr>
                        <td>${section.id}</td>
                        <td>${section.name}</td>
                        <td>${section.school_class.name}</td>
                        <td>
                            <button class="btn btn-sm btn-info edit-section" data-id="${section.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-section" data-id="${section.id}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#sectionTable tbody').html(rows);
            
            
               $('#sectionTable').DataTable({
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

       function fetchSectionsEdit() {
        $.get('/sections/list', function (data) {
            let rows = '';
            $.each(data, function (index, section) {
                rows += `
                    <tr>
                        <td>${section.id}</td>
                        <td>${section.name}</td>
                        <td>${section.school_class.name}</td>
                        <td>
                            <button class="btn btn-sm btn-info edit-section" data-id="${section.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-section" data-id="${section.id}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#sectionTable tbody').html(rows);
            
        });
    }

$('#sectionForm').on('submit', function (e) {
    e.preventDefault();

    let sectionId = $('#section_id').val();
    let url = sectionId ? `/sections/${sectionId}` : '/sections';
    let method = sectionId ? 'PUT' : 'POST';

    $.ajax({
        url: url,
        type: method,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            name: $('#section_name').val(),
            school_class_id: $('#school_class_id').val()
        },
        success: function () {
            $('#sectionForm')[0].reset();
            $('#section_id').val('');
            $('#sectionModal').modal('hide');
          $('#sectionModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('overflow', 'auto');
    });
            fetchSectionsEdit();
        },
        error: function (xhr) {
            alert(xhr.responseJSON.message);
            $('#sectionForm')[0].reset();

        }
    });
});


$(document).on('click', '.edit-section', function () {
    let id = $(this).data('id');

    $.get(`/sections/${id}/edit`, function (section) {
        $('#section_id').val(section.id);
        $('#section_name').val(section.name);
        $('#school_class_id').val(section.school_class_id);

        // Bootstrap 5 modal show
        const modal = new bootstrap.Modal(document.getElementById('sectionModal'));
        modal.show();
    });
});



// Open Delete Modal
$(document).on('click', '.delete-section', function () {
    let id = $(this).data('id');
    $('#delete_section_id').val(id);
    $('#deleteSectionModal').modal('show');
});

// Confirm Delete
$('#confirmDeleteSection').on('click', function () {
    let id = $('#delete_section_id').val();

    $.ajax({
        url: `/sections/${id}`,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (res) {
            $('#deleteSectionModal').modal('hide');
            fetchSectionsEdit();
        },
        error: function (err) {
            alert('Error deleting section');
        }
    });
});


});
