@push('styles')
@vite('resources/css/Admin/blogs/listBlog.css')
@endpush

@push('scripts')
@vite('resources/js/Admin/blogs/listBlog.js')
@vite('resources/js/Admin/blogs/editBlog.js')
@endpush

<x-default-admin-layout :title="'Blog Management'">
    <div class="card">
        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="text-lg font-semibold text-gray-800">Blog Management</h2>

            <div class="d-flex align-items-center gap-2">
                {{-- SEARCH --}}
                <div class="search-container position-relative">
                    <i class="fa-solid fa-magnifying-glass position-absolute" style="left:10px; top:50%; transform:translateY(-50%);"></i>
                    <input type="text" id="searchInput" class="form-control ps-5" placeholder="Search by title or content" />
                </div>

            </div>
        </div>

        {{-- FILTER MENU (Collapse) --}}
        <div class="collapse" id="filterMenu">
            <div class="card card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label>Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end gap-2">
                        <button type="button" class="btn btn-light reset-filter-btn">Clear Filters</button>
                        <button type="button" class="btn btn-primary apply-filter-btn">Apply Filters</button>
                    </div>
                </div>
            </div>
        </div>

        @include('Admin.blogs.modals.editBlogs')

        {{-- BODY --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold" 
                 id="blogs-table" data-url="{{ route('admin_blogs_table') }}">
                    <thead class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <tr>
                            <th><input type="checkbox" class="select-all-checkbox"></th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="blogsTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

</x-default-admin-layout>
