<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Blog\BlogRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    protected $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * Blog listing page
     */
    public function index()
    {
        return view('Admin.blogs.listBlogs');
    }

    /**
     * Datatable AJAX
     */
    public function table(Request $request)
    {

        $query = $this->blogs->getForDataTable([
            'search'    => $request->search,
            'status'    => $request->status,
            'date_from' => $request->date_from,
            'date_to'   => $request->date_to,
        ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status', function ($blog) {
                return ucfirst($blog->status);
            })
            ->editColumn('created_at', function ($blog) {
                return $blog->created_at->format('d M Y');
            })
            ->addColumn('action', function ($blog) {
                return view('Admin.blogs.columns._actions', compact('blog'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store new blog
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'status'      => 'required|in:pending,publish,rejected',
            'blog_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'status']);

        if ($request->hasFile('blog_image')) {
            $data['image'] = $request->file('blog_image')->store('blogs', 'public');
        }

        $this->blogs->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Blog added successfully',
        ]);
    }

    /**
     * Get blog for edit / approve modal
     */
    public function edit($id)
    {
        $blog = $this->blogs->find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    /**
     * Update blog status (Approve / Reject)
     */
    public function update(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'status'  => 'required|in:pending,publish,rejected',
        ]);

        $blog = $this->blogs->find($request->blog_id);

        $this->blogs->update($blog, [
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog status updated successfully',
        ]);
    }

    /**
     * Delete blog
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $blog = $this->blogs->find($request->blog_id);

        $this->blogs->delete($blog);

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully',
        ]);
    }
}
