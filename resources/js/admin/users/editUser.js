$(document).ready(function () {
    // Edit button click
    $(document).on('click', '.edit-btn', function () {
        let userId = $(this).data('id');

        $.ajax({
            url: `/admin/users/edit/${userId}`,
            method: 'GET',
            success: function (response) {
                // Fill modal fields with correct IDs
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#edit_role').val(response.role);
                $('#edit_user_id').val(response.id);

                // Show modal
                const myModalEl = document.getElementById('editUserModal');
                const myModal = new bootstrap.Modal(myModalEl); // Use Bootstrap 5
                myModal.show();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to fetch user data!'
                });
            }
        });
    });

    // Update form submit
    $('#editUserForm').submit(function (e) {
        e.preventDefault();
        const userId = $('#edit_user_id').val();
        const data = $(this).serialize();

        $.ajax({
            url: `/admin/users/update`,
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    const modalEl = document.getElementById('editUserModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide(); // Properly hide modal with Bootstrap 5

                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'User updated successfully'
                    });

                    $('#users-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: response.message || 'Failed to update user'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong!'
                });
            }
        });
    });
});
