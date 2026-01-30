<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\User\UserRepository;
use App\Repositories\Admin\Blog\BlogRepository;

class DashboardController extends Controller
{
    protected $users;
    protected $blogs;

    public function __construct(UserRepository $users, BlogRepository $blogs)
    {
        $this->users = $users;
        $this->blogs = $blogs;
    }

    public function index()
    {
        // User stats
        $totalUsers  = $this->users->getForDataTable()->count();
        $recentUsers = $this->users->getForDataTable([], 5)->orderBy('created_at', 'desc')->limit(5)->get();

        // Blog stats
        $totalBlogs     = $this->blogs->countAll();
        $pendingBlogs   = $this->blogs->countByStatus('pending');
        $publishedBlogs = $this->blogs->countByStatus('published');
        $rejectedBlogs  = $this->blogs->countByStatus('rejected');
        $draftBlogs     = $this->blogs->countByStatus('draft');
        $recentBlogs    = $this->blogs->recent(5);

        return view('admin.dashboard', compact(
            'totalUsers',
            'recentUsers',
            'totalBlogs',
            'pendingBlogs',
            'publishedBlogs',
            'rejectedBlogs',
            'draftBlogs',
            'recentBlogs'
        ));
    }
}
