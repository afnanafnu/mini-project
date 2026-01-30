<?php

namespace App\Repositories\Web\Blog;

use App\Models\Blog;
use Illuminate\Http\UploadedFile;

class BlogRepository
{
    public function store(array $data): Blog
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('blogs', 'public');
        }

        $data['status'] = 'pending'; // admin approval

        return Blog::create($data);
    }

    public function getApprovedBlogs(int $perPage = 6)
    {
        return Blog::where('status', 'publish')
            ->latest()
            ->paginate($perPage);
    }
}
