// resources/js/admin/sidebar.js
$(document).ready(function () {

    // Set active link based on current URL
    const currentPath = window.location.pathname;

    $('.sidebar-menu a').each(function () {
        const linkPath = $(this).attr('href');

        if (
            linkPath === currentPath ||
            (linkPath !== '#' && currentPath.startsWith(linkPath))
        ) {
            $(this).addClass('active');
        }
    });

    // Logout button confirmation + loading state
    $('.logout-btn').on('click', function (e) {
        if (!confirm('Are you sure you want to logout?')) {
            e.preventDefault();
        } else {
            $(this)
                .html('<i class="fa-solid fa-spinner fa-spin"></i> Logging out...')
                .prop('disabled', true);
        }
    });

    // Mobile menu toggle
    function createMobileToggle() {
        if ($(window).width() <= 768) {

            // Prevent duplicate toggle buttons
            if ($('.sidebar-toggle').length === 0) {
                const toggleBtn = $(`
                    <button class="sidebar-toggle">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                `);

                $('.sidebar-logo').append(toggleBtn);

                toggleBtn.on('click', function () {
                    $('.admin-sidebar').toggleClass('mobile-open');
                });
            }
        }
    }

    createMobileToggle();
    $(window).on('resize', createMobileToggle);
});
