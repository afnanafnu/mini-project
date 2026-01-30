<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Web\Blog\BlogRepository;

class HomeController extends Controller
{
    protected $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    public function index()
    {
        // Get only published blogs
        $blogs = $this->blogs->getApprovedBlogs(6); // limit optional

        return view('web.home.index', compact('blogs'));
    }
}
