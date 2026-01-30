@push('styles')
@vite('resources/css/web/home/home.css')
@endpush

@push('scripts')
@vite('resources/js/web/home/home.js')
@endpush

<x-default-layout :title="'Premium Blog Platform'">

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Discover Amazing Blogs</h1>
            <p>Read quality articles written by experts from different domains.</p>
            <a href="#submit-blog" class="btn btn-primary">Submit Your Blog</a>
        </div>
    </section>

    <!-- BLOG LIST -->
    <section class="blog-section">
        <div class="container">
            <h2 class="section-title">Latest Blogs</h2>

            <div class="blog-grid">
                @forelse($blogs as $blog)
                <div class="blog-card">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">

                    <div class="blog-content">
                        <span class="category">{{ ucfirst($blog->category) }}</span>
                        <h3>{{ $blog->title }}</h3>
                        <p>{{ Str::limit($blog->content, 120) }}</p>

                        <div class="blog-footer">
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                            <span class="status {{ $blog->status }}">{{ ucfirst($blog->status) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted">No blogs available.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>

    <!-- SUBMIT BLOG -->
    <section id="submit-blog" class="submit-blog" data-login-url="{{ route('user_login') }}">
        <div class="container">
            <h2 class="section-title text-center">Submit a Blog</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form id="blogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Blog Title -->
                <div class="form-group mb-3">
                    <input type="text" name="title" placeholder="Blog Title" value="{{ old('title') }}" required>
                    @error('title')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Blog Content -->
                <div class="form-group mb-3">
                    <textarea name="content" rows="6" placeholder="Write your blog content..." required>{{ old('content') }}</textarea>
                    @error('content')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div class="form-group mb-3">
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg">
                    @error('image')
                    <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                @auth('web')
                <button type="submit" class="btn btn-primary">please Submit for Review</button>
                @else
                <button type="button" id="loginPrompt" class="btn btn-primary">Submit for Review</button>
                @endauth
            </form>

        </div>
    </section>


</x-default-layout>