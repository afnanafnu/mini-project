<?php

namespace App\Repositories\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Get users for DataTables with filters
     */
    public function getForDataTable(array $filters = [], int $limit = null)
    {
        $query = $this->model->query();

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('email', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Create a new user
     */
    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return $this->model->create($data);
    }

    /**
     * Update user
     */
    public function update(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    /**
     * Delete user
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    /**
     * Find user by ID
     */
    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }
}
