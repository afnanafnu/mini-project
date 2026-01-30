<?php

namespace App\Repositories\Admin\Blog;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;

class BlogRepository
{
    protected $model;

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * Get blogs for DataTables with filters
     */
    public function getForDataTable(array $filters = [])
    {
        $query = $this->model->query();

        // Search by title or content
        if (!empty($filters['search'])) {
            $query->where(function (Builder $q) use ($filters) {
                $q->where('title', 'like', "%{$filters['search']}%")
                    ->orWhere('content', 'like', "%{$filters['search']}%");
            });
        }

        // Status filter
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Date range filter
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query;
    }

    /**
     * Create a new blog
     */
    public function create(array $data): Blog
    {
        return $this->model->create($data);
    }

    /**
     * Update blog
     */
    public function update(Blog $blog, array $data): Blog
    {
        $blog->update($data);
        return $blog;
    }

    /**
     * Delete blog
     */
    public function delete(Blog $blog): bool
    {
        return $blog->delete();
    }

    /**
     * Find blog by ID
     */
    public function find(int $id): ?Blog
    {
        return $this->model->find($id);
    }

    public function countAll(): int
    {
        return $this->model->count();
    }

    public function countByStatus(string $status): int
    {
        return $this->model->where('status', $status)->count();
    }

    public function recent(int $limit = 5)
    {
        return $this->model->with('author')->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
