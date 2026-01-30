$(document).ready(function () {

    // Initialize DataTable
    let blogsTable = $('#blogs-table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        searching: false,
        lengthChange: true,
        pageLength: 10,

        ajax: {
            url: $('#blogs-table').data('url'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                // Convert DataTables paging to Laravel pagination
                d.page = (d.start / d.length) + 1;
                d.per_page = d.length;

                // Filters
                d.search = $('#searchInput').val();
                d.status = $('#statusFilter').val() || null;

                delete d.length; // Remove default length
            },
            dataSrc: function (json) {
                return json.data || [];
            },
            error: function () {
                $('#blogs-table tbody').html(`
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            Failed to load blogs
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
            { data: 'title', name: 'title' },
            { data: 'content', name: 'content', render: function(data) {
                return data.length > 100 ? data.substr(0, 100) + '...' : data;
            }},
            { data: 'status', name: 'status', render: function(data) {
                let badge = 'secondary';
                if (data === 'published') badge = 'success';
                if (data === 'draft') badge = 'warning';
                if (data === 'archived') badge = 'dark';
                return `<span class="badge bg-${badge}">${data}</span>`;
            }},
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']],
        drawCallback: function () {
            // Show/hide bulk actions
            if (this.api().data().count()) {
                $('.bulk-actions').show();
            } else {
                $('.bulk-actions').hide();
            }
        }
    });

    // SEARCH input
    $('#searchInput').on('keyup', function () {
        blogsTable.ajax.reload();
    });

    // SELECT ALL CHECKBOX
    $('.select-all-checkbox').on('change', function () {
        $('.row-checkbox').prop('checked', $(this).is(':checked'));
    });

    // OPEN MODAL
    $('.add-user-btn').on('click', function () {
        const modalSelector = $(this).data('modal');
        $(modalSelector).fadeIn();
    });

    // CLOSE MODAL
    $('.close-modal-btn').on('click', function () {
        $(this).closest('.modal-overlay').fadeOut();
    });

    $('.modal-overlay').on('click', function (e) {
        if ($(e.target).is('.modal-overlay')) {
            $(this).fadeOut();
        }
    });

    // DELETE BLOG
    $(document).on('click', '.delete-btn', function () {
        const blogId = $(this).data('id');

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
                $.ajax({
                    url: `/admin/blogs/delete`,
                    type: 'get',
                    data: { blog_id: blogId },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Blog has been deleted.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            blogsTable.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to delete blog'
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
