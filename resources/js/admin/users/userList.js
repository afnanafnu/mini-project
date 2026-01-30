$(document).ready(function () {

    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        searching: false,
        lengthChange: true,
        pageLength: 10,

        ajax: {
            url: $('#users-table').data('url'), // route('users_table')
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                // Convert DataTable params to Laravel pagination
                d.page = (d.start / d.length) + 1;
                d.per_page = d.length;

                // Filters
                d.search = $('#searchInput').val();
                d.status = $('#statusFilter').val() || null;
                d.role = $('#roleFilter').val() || null;
                d.date_from = $('#dateFrom').val() || null;
                d.date_to = $('#dateTo').val() || null;

                delete d.length;
            },
            dataSrc: function (json) {
                return json.data || [];
            },
            error: function () {
                $('#users-table tbody').html(`
                    <tr>
                        <td colspan="7" class="text-center text-danger">
                            Failed to load users
                        </td>
                    </tr>
                `);
            }
        },

        columns: [
            {
                data: 'id',
                orderable: false,
                render: function (data) {
                    return `<input type="checkbox" class="row-checkbox" data-id="${data}">`;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[0, 'asc']],
        drawCallback: function () {
            // Initialize dropdowns after table redraw
            document.querySelectorAll('.dropdown-toggle').forEach((dropdownToggleEl) => {
                new Dropdown(dropdownToggleEl);
            });

            // Show/hide bulk actions
            if (this.api().data().count()) {
                $('.bulk-actions').show();
            } else {
                $('.bulk-actions').hide();
            }
        }
    });

    /* ==============================
       SEARCH
    ============================== */
    $('#searchInput').on('keyup', function () {
        table.ajax.reload();
    });

    /* ==============================
       SELECT ALL
    ============================== */
    $('.select-all-checkbox').on('change', function () {
        $('.row-checkbox').prop('checked', $(this).is(':checked'));
    });

    /* ==============================
      OPEN MODAL
   ============================== */
    $('.add-user-btn').on('click', function () {
        const modalSelector = $(this).data('modal');
        $(modalSelector).fadeIn();
    });

    /* ==============================
       CLOSE MODAL
    ============================== */
    $('.close-modal-btn').on('click', function () {
        $(this).closest('.modal-overlay').fadeOut();
    });

    /* ==============================
       CLOSE MODAL BY CLICKING OUTSIDE
    ============================== */
    $('.modal-overlay').on('click', function (e) {
        if ($(e.target).is('.modal-overlay')) {
            $(this).fadeOut();
        }
    });


    // Delete button click
    $(document).on('click', '.delete-btn', function () {
        const userId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with deletion
                $.ajax({
                    url: `/admin/users/delete`,
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: userId
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'User has been deleted.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to delete user'
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
            }
        });
    });
});
