<header class="main-header" id="app" data-logged-in="{{ auth()->check() ? '1' : '0' }}">
    <div class="header-container">
        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-newspaper"></i>
            <span>Platform Premium Blog</span>
        </div>

        <!-- Navigation -->
        <nav class="nav-menu">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="#" class="{{ request()->is('blogs*') ? 'active' : '' }}">Blogs</a>
            <a href="#" class="{{ request()->is('reports*') ? 'active' : '' }}">Reports</a>
        </nav>

        <!-- Right side -->
        <div class="header-right">
            <input type="text" class="search-input" placeholder="Search...">

            @auth('web')
                <!-- If user is logged in -->
                <div class="user-menu">
                    <img src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}" alt="User" class="avatar">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('user_logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            @else
                <!-- If user is not logged in -->
                <a href="{{ route('user_login') }}" class="btn-login">Login</a>
                <a href="{{ route('user_register') }}" class="btn-register">Register</a>
            @endauth
        </div>
    </div>
</header>
