$(document).ready(function () {

    // ============================
    // File input validation
    // ============================
    $('input[type="file"]').on('change', function () {
        const file = this.files[0];
        if (!file) return;

        const allowed = ['image/jpeg', 'image/png', 'image/jpg'];

        if (!allowed.includes(file.type.trim())) {
            alert('Only JPG, JPEG, PNG images allowed');
            $(this).val('');
            return;
        }

        if (file.size > 1024 * 1024) {
            alert('Image size must be less than 1MB');
            $(this).val('');
        }
    });

    // ============================
    // Blog form submission
    // ============================
    const isLoggedIn = $('#app').data('logged-in') === 1 || $('#app').data('logged-in') === '1';

    if (isLoggedIn) {
        console.log('User is logged in');
    } else {
        console.log('User is NOT logged in');
    }

    // Example: disable submit button if not logged in
    $('#blogForm').on('submit', function (e) {
        if (!isLoggedIn) {
            e.preventDefault();
            Swal.fire({
                title: 'You must be logged in!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user_login') }}";
                }
            });
        }
    });

    // ============================
    // Optional: login prompt button
    // ============================
    $('#loginPrompt').on('click', function () {

        Swal.fire({
            title: 'You must be logged in!',
            text: "Please login to submit a blog.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $('.submit-blog').data('login-url');
            }
        });
    });

});
