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
                        <td>${section.class.name}</td>
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
        let formData = $(this).serialize();
        $.post('/sections', formData, function (res) {
            $('#sectionForm')[0].reset();
            $('#sectionModal').modal('hide');
            fetchSections();
        }).fail(function (xhr) {
            alert(xhr.responseText);
        });
    });

    $(document).on('click', '.edit-section', function () {
        const id = $(this).data('id');
        $.get('/sections/' + id, function (section) {
            $('#section_id').val(section.id);
            $('#name').val(section.name);
            $('#school_class_id').val(section.school_class_id);
            $('#sectionModal').modal('show');
        });
    });

    $(document).on('click', '.delete-section', function () {
        if (confirm('Are you sure you want to delete this section?')) {
            const id = $(this).data('id');
            $.ajax({
                url: '/sections/' + id,
                type: 'DELETE',
                data: { _token: $('input[name="_token"]').val() },
                success: function () {
                    fetchSections();
                }
            });
        }
    });
});
