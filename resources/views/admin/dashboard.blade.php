@push('styles')
    @vite('resources/css/Admin/dashboard/dashboard.css')
@endpush

@push('scripts')
    @vite('resources/js/Admin/dashboard/dashboard.js')
@endpush

<x-default-admin-layout :title="'Dashboard'">

    <div class="dashboard">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Welcome back, Admin!</h1>
            <p>Here's what's happening with your blog management system today.</p>
        </div>

        <!-- Stats Cards -->
        <div class="dashboard-cards">
            <div class="card card-users">
                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3>Total Users</h3>
                <p>Manage system users and permissions</p>
                <div class="card-stat">{{ $totalUsers ?? '1,254' }}</div>
                <div class="card-growth growth-positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>12.5% from last month</span>
                </div>
            </div>

            <div class="card card-products">
                <div class="card-icon">
                    <i class="fa-solid fa-blog"></i>
                </div>
                <h3>Total Blogs</h3>
                <p>Manage blog posts and content</p>
                <div class="card-stat">{{ $totalBlogs ?? '342' }}</div>
                <div class="card-growth growth-positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>8.2% from last month</span>
                </div>
            </div>

            <div class="card">
                <div class="card-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h3>Pending Blogs</h3>
                <p>Blogs awaiting approval</p>
                <div class="card-stat">{{ $pendingBlogs ?? '18' }}</div>
                <div class="card-growth growth-negative">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>3 from yesterday</span>
                </div>
            </div>

            <div class="card">
                <div class="card-icon" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <h3>Published Blogs</h3>
                <p>Active published blogs</p>
                <div class="card-stat">{{ $publishedBlogs ?? '280' }}</div>
                <div class="card-growth growth-positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>15.3% from last month</span>
                </div>
            </div>
        </div>

        <!-- User Management Section -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>User Management</h2>
                <a href="{{ route('admin_users_index') }}">
                    View All Users
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUsers ?? [] as $user)
                            <tr>
                                <td>#{{ $user->id ?? '001' }}</td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ substr($user->name ?? 'JD', 0, 2) }}
                                        </div>
                                        <span>{{ $user->name ?? 'John Doe' }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email ?? 'john@example.com' }}</td>
                                <td>
                                    <span class="role-badge role-{{ strtolower($user->role ?? 'user') }}">
                                        {{ $user->role ?? 'User' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status status-{{ $user->status ?? 'active' }}">
                                        {{ $user->status ?? 'Active' }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at ? $user->created_at->format('M d, Y') : 'Jan 15, 2024' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view-btn" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit-btn" title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete-btn" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Blog Management Section -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>Blog Management</h2>
                <a href="{{ route('admin_blogs_index') }}">
                    View All Blogs
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Blog ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBlogs ?? [] as $blog)
                            <tr>
                                <td>#{{ $blog->id ?? '101' }}</td>
                                <td class="blog-title">
                                    <div class="blog-info">
                                        @if($blog->image ?? false)
                                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-thumbnail">
                                        @endif
                                        <div class="blog-content">
                                            <strong>{{ Str::limit($blog->title ?? 'Sample Blog Title', 40) }}</strong>
                                            <p class="blog-excerpt">{{ Str::limit($blog->content ?? 'Sample blog content...', 60) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $blog->author->name ?? 'Admin User' }}</td>
                                <td>
                                    <span class="category-badge">{{ $blog->category ?? 'Technology' }}</span>
                                </td>
                                <td>
                                    @php
                                        $status = $blog->status ?? 'pending';
                                        $statusClass = $status === 'published' ? 'active' : ($status === 'rejected' ? 'rejected' : 'pending');
                                    @endphp
                                    <span class="status status-{{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td>{{ $blog->views ?? '1,234' }}</td>
                                <td>{{ $blog->created_at ? $blog->created_at->format('M d, Y') : 'Jan 20, 2024' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view-btn" title="Preview">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit-btn" title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        @if($blog->status !== 'published')
                                            <button class="action-btn publish-btn" title="Publish">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        @endif
                                        @if($blog->status !== 'rejected')
                                            <button class="action-btn reject-btn" title="Reject">
                                                <i class="fa-solid fa-times"></i>
                                            </button>
                                        @endif
                                        <button class="action-btn delete-btn" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No blogs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Blog Status Summary -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>Blog Status Overview</h2>
            </div>
            <div class="status-summary">
                <div class="status-card status-published">
                    <div class="status-icon">
                        <i class="fa-solid fa-check-circle"></i>
                    </div>
                    <div class="status-content">
                        <h3>Published</h3>
                        <p class="status-count">{{ $publishedBlogs ?? '280' }}</p>
                        <p class="status-percentage">68% of total</p>
                    </div>
                </div>
                <div class="status-card status-pending">
                    <div class="status-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="status-content">
                        <h3>Pending</h3>
                        <p class="status-count">{{ $pendingBlogs ?? '18' }}</p>
                        <p class="status-percentage">4% of total</p>
                    </div>
                </div>
                <div class="status-card status-rejected">
                    <div class="status-icon">
                        <i class="fa-solid fa-times-circle"></i>
                    </div>
                    <div class="status-content">
                        <h3>Rejected</h3>
                        <p class="status-count">{{ $rejectedBlogs ?? '5' }}</p>
                        <p class="status-percentage">1% of total</p>
                    </div>
                </div>
                <div class="status-card status-draft">
                    <div class="status-icon">
                        <i class="fa-solid fa-edit"></i>
                    </div>
                    <div class="status-content">
                        <h3>Draft</h3>
                        <p class="status-count">{{ $draftBlogs ?? '39' }}</p>
                        <p class="status-percentage">9% of total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="dashboard-section">
            <div class="section-header">
                <h2>Quick Actions</h2>
            </div>
            <div class="quick-actions">
                <a href="{{ route('admin_users_create') }}" class="action-btn">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Add New User</span>
                </a>
                <a href="{{ route('admin_blogs_create') }}" class="action-btn">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Create Blog</span>
                </a>
                <a href="{{ route('admin_blogs_index', ['status' => 'pending']) }}" class="action-btn">
                    <i class="fa-solid fa-clock"></i>
                    <span>Review Pending</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>View Reports</span>
                </a>
            </div>
        </div>
    </div>

</x-default-admin-layout>