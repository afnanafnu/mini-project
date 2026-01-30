import { Modal } from 'bootstrap';

$(document).ready(function () {

    // ==============================
    // OPEN EDIT BLOG MODAL
    // ==============================
    $(document).on('click', '.edit-btn', function () {
        const blogId = $(this).data('id');

        $.ajax({
            url: `/admin/blogs/edit/${blogId}`,
            method: 'GET',
            success: function (response) {
                // Fill modal fields
                $('#edit_blog_id').val(response.id);
                $('#edit_blog_title').val(response.title);
                $('#edit_blog_content').val(response.content);
                $('#edit_blog_status').val(response.status);

                // Set image preview
                if (response.image) {
                    $('#edit_blog_image_preview').attr('src', `/storage/${response.image}`);
                } else {
                    $('#edit_blog_image_preview').attr('src', 'https://via.placeholder.com/400x200?text=No+Image');
                }

                // Show modal
                const editModalEl = document.getElementById('editBlogModal');
                const editModal = new Modal(editModalEl); // Correct usage
                editModal.show();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to fetch blog data!'
                });
            }
        });
    });

    // ==============================
    // UPDATE BLOG STATUS
    // ==============================
    $('#editBlogForm').submit(function (e) {
        e.preventDefault();

        const blogId = $('#edit_blog_id').val();
        const formData = new FormData(this);

        $.ajax({
            url: `/admin/blogs/update`,
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    const editModalEl = document.getElementById('editBlogModal');
                    const editModal = Modal.getInstance(editModalEl); // Correct usage
                    editModal.hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Blog updated successfully',
                        timer: 1800,
                        showConfirmButton: false
                    });

                    // Reload DataTable
                    $('#blogs-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message || 'Failed to update blog'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
    });

});
