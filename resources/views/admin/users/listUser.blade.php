@push('styles')
@vite('resources/css/Admin/users/userList.css')
@endpush

@push('scripts')
@vite('resources/js/Admin/users/userList.js')
@vite('resources/js/Admin/users/addUser.js')
@vite('resources/js/Admin/users/editUser.js')
@endpush

<x-default-admin-layout :title="'User Management'">

    <div class="card">
        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="text-lg font-semibold text-gray-800">User Management</h2>

            <div class="d-flex align-items-center gap-2">
                {{-- SEARCH --}}
                <div class="search-container position-relative">
                    <i class="fa-solid fa-magnifying-glass position-absolute" style="left:10px; top:50%; transform:translateY(-50%);"></i>
                    <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search by name or email" />
                </div>

                {{-- ADD USER BUTTON --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fa-solid fa-user-plus"></i> Add User
                </button>
            </div>
        </div>

        @include('Admin.users.modals.addUser')
        @include('Admin.users.modals.editUser')

        {{-- BODY --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold" 
                 id="users-table" data-url="{{ route('admin_users_table') }}">
                    <thead class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <tr>
                            <th><input type="checkbox" class="select-all-checkbox"></th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

</x-default-admin-layout>