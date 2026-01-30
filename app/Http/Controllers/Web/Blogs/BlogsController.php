<?php

namespace App\Http\Controllers\Web\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\blogs\BlogStoreRequest;
use App\Repositories\Web\Blog\BlogRepository;

class BlogsController extends Controller
{
    protected BlogRepository $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    public function index()
    {
        return view('web.blogs.index');
    }

    /**
     * Store blog from frontend
     */
    public function storeBlog(BlogStoreRequest $request)
    {
        $blog =$this->blogs->store($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Blog submitted successfully. Waiting for admin approval.');
    }
}
