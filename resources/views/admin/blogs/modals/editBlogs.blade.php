<div class="modal fade" id="editBlogModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- larger modal for content -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Blog / Approve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBlogForm" action="#" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="edit_blog_id" name="blog_id">

                    {{-- Blog Image Preview --}}
                    <div class="mb-3 text-center">
                        <img id="edit_blog_image_preview" src="" alt="Blog Image" class="img-fluid rounded" style="max-height: 200px;">
                    </div>

                    {{-- Blog Title (readonly) --}}
                    <div class="mb-3">
                        <label for="edit_blog_title" class="form-label">Title</label>
                        <input type="text" id="edit_blog_title" name="title" class="form-control" readonly>
                    </div>

                    {{-- Blog Content (readonly) --}}
                    <div class="mb-3">
                        <label for="edit_blog_content" class="form-label">Content</label>
                        <textarea id="edit_blog_content" name="content" class="form-control" rows="5" readonly></textarea>
                    </div>

                    {{-- Status Dropdown --}}
                    <div class="mb-3">
                        <label for="edit_blog_status" class="form-label">Status</label>
                        <select id="edit_blog_status" name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="publish">Publish</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
