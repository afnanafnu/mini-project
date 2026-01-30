<aside class="admin-sidebar">
    <div class="sidebar-logo">
        <i class="fa-solid fa-building"></i>
        <span>PropertyPro</span>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('admin_dashboard') }}">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>

        <a href="{{ route('admin_users_index') }}">
            <i class="fa-solid fa-users"></i>
            Users
        </a>

        <a href="{{ route('admin_blogs_index') }}">
            <i class="fa-solid fa-box"></i>
            Blogs
        </a>

        <form method="POST" action="{{ route('admin_logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </nav>
</aside>
