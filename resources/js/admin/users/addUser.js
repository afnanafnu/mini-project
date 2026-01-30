$(document).ready(function () {
    // Initialize form validation for Add User modal
    $("#addUserForm").validate({
        rules: {
            name: { required: true, minlength: 3 },
            email: { required: true, email: true },
            role: { required: true },
            password: { required: true, minlength: 6 },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "Full name is required",
                minlength: "Full name must be at least 3 characters"
            },
            email: {
                required: "Email is required",
                email: "Please enter a valid email"
            },
            role: {
                required: "Please select a role"
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 6 characters"
            },
            password_confirmation: {
                required: "Please confirm password",
                equalTo: "Passwords do not match"
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element); // Place error after element
        }
    });

    // Reset form when modal is hidden
    $("#addUserModal").on("hidden.bs.modal", function () {
        let form = $("#addUserForm");
        form[0].reset();
        form.validate().resetForm(); // Remove validation messages
    });

    // Handle form submission
    $("#addUserForm").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        if (!form.valid()) return; // Stop if form is invalid

        let submitBtn = form.find("button[type='submit']");
        submitBtn.prop("disabled", true);

        $.ajax({
            url: '/admin/users/create', // your backend route
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User added successfully',
                        timer: 1800,
                        showConfirmButton: false
                    });

                    let table = $('#users-table').DataTable();
                    table.ajax.reload(null, false);

                    // Hide modal using Bootstrap 5 method
                    const addModalEl = document.getElementById('addUserModal');
                    const addModal = bootstrap.Modal.getInstance(addModalEl) || new bootstrap.Modal(addModalEl);
                    addModal.hide();

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.message || 'Failed to add user'
                    });
                }
                submitBtn.prop("disabled", false);
            },
            error: function (xhr) {
                let errorMsg = "An error occurred. Please try again.";
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let allErrors = Object.values(xhr.responseJSON.errors).flat();
                    errorMsg = allErrors.join("<br>");
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: errorMsg,
                    confirmButtonText: 'OK',
                    customClass: { confirmButton: 'btn btn-primary' }
                });

                submitBtn.prop("disabled", false);
            }
        });
    });
});
