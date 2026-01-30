@push('styles')
@vite('resources/css/web/home/home.css')
@endpush

@push('scripts')
@vite('resources/js/web/home/home.js')
@endpush

<x-default-layout :title="'Premium Blog Platform'">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1 class="animate__animated animate__fadeInDown">Welcome to Our Blog Platform</h1>
            <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Discover insightful articles, expert opinions, and engaging content across various topics. Read, learn, and get inspired.</p>
            <div class="mt-4 animate__animated animate__fadeInUp animate__delay-2s">
                <div class="hero-actions">
                    <a href="#submit-blog" class="btn btn-primary btn-lg me-3"><i class="fas fa-plus-circle me-2"></i> Submit Blog</a>
                    <form action="#" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search articles..." name="search">
                            <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Listing Section -->
    <section class="blog-listing py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="section-title mb-0 animate-on-scroll">Latest Articles</h2>
                        <div class="sort-options animate-on-scroll">
                            <select class="form-select form-select-sm">
                                <option value="latest">Latest First</option>
                                <option value="popular">Most Popular</option>
                                <option value="oldest">Oldest First</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Blog List -->
                    <div class="blog-list">
                        @for($i = 1; $i <= 6; $i++)
                        <article class="blog-list-item animate-on-scroll">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="position-relative overflow-hidden">
                                        <img src="https://source.unsplash.com/400x300/?blog,article,{{$i}}" class="blog-list-img" alt="Article {{$i}}">
                                        <span class="blog-badge bg-primary">New</span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="blog-list-content">
                                        <div class="blog-meta">
                                            <span class="blog-category @if($i % 4 == 0)tech @elseif($i % 4 == 1)business @elseif($i % 4 == 2)lifestyle @else education @endif">
                                                @if($i % 4 == 0)Technology
                                                @elseif($i % 4 == 1)Business
                                                @elseif($i % 4 == 2)Lifestyle
                                                @else Education
                                                @endif
                                            </span>
                                            <span class="blog-date"><i class="far fa-calendar me-1"></i> Dec {{15 - $i}}, 2024</span>
                                            <span class="blog-read-time"><i class="far fa-clock me-1"></i> {{rand(3, 10)}} min read</span>
                                        </div>
                                        <h3 class="blog-title">
                                            <a href="#">
                                                @if($i == 1)
                                                How to Build a Successful Startup in 2024
                                                @elseif($i == 2)
                                                The Impact of Remote Work on Productivity
                                                @elseif($i == 3)
                                                10 Healthy Habits for Better Mental Health
                                                @elseif($i == 4)
                                                Machine Learning: A Beginner's Guide
                                                @elseif($i == 5)
                                                Financial Planning for Young Professionals
                                                @else
                                                The Future of Online Education
                                                @endif
                                            </a>
                                        </h3>
                                        <p class="blog-excerpt">
                                            @if($i == 1)
                                            Essential steps and strategies for launching your dream startup this year with proven methods...
                                            @elseif($i == 2)
                                            Research and insights about how remote work affects team performance and productivity metrics...
                                            @elseif($i == 3)
                                            Practical tips to improve your mental wellbeing and develop healthy daily habits for better life...
                                            @elseif($i == 4)
                                            Start your journey into machine learning with this comprehensive guide covering basics to advanced...
                                            @elseif($i == 5)
                                            Smart money management strategies for early career professionals to achieve financial freedom...
                                            @else
                                            How digital learning is reshaping traditional education systems and creating new opportunities...
                                            @endif
                                        </p>
                                        <div class="blog-footer">
                                            <div class="author-info">
                                                <img src="https://source.unsplash.com/40x40/?portrait,person,{{$i}}" alt="Author" class="author-avatar-sm">
                                                <div>
                                                    <span class="author-name">
                                                        @if($i % 3 == 0)Alex Turner
                                                        @elseif($i % 3 == 1)Maria Garcia
                                                        @else David Chen
                                                        @endif
                                                    </span>
                                                    <span class="author-role">
                                                        @if($i % 3 == 0)Senior Editor
                                                        @elseif($i % 3 == 1)Content Writer
                                                        @else Tech Writer
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="blog-stats">
                                                <span><i class="far fa-eye"></i> {{rand(500, 2500)}}</span>
                                                <span><i class="far fa-comment"></i> {{rand(5, 50)}}</span>
                                                <span><i class="far fa-heart"></i> {{rand(20, 200)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endfor
                    </div>
                    
                    <!-- Pagination -->
                    <nav class="mt-5 animate-on-scroll">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Submit Blog Widget -->
                    <div class="sidebar-widget submit-widget animate-on-scroll">
                        <div class="widget-header">
                            <h4><i class="fas fa-pen-alt me-2"></i> Write for Us</h4>
                        </div>
                        <div class="widget-content">
                            <p>Share your knowledge and experience with our community. Submit your blog post today!</p>
                            <a href="#submit-blog" class="btn btn-primary w-100">
                                <i class="fas fa-plus-circle me-2"></i> Submit Blog Post
                            </a>
                        </div>
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="sidebar-widget categories-widget animate-on-scroll">
                        <div class="widget-header">
                            <h4><i class="fas fa-folder me-2"></i> Categories</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="categories-list">
                                <li>
                                    <a href="#">
                                        <span class="category-name">Technology</span>
                                        <span class="category-count">245</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="category-name">Business</span>
                                        <span class="category-count">189</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="category-name">Lifestyle</span>
                                        <span class="category-count">156</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="category-name">Education</span>
                                        <span class="category-count">210</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="category-name">Health</span>
                                        <span class="category-count">98</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="category-name">Travel</span>
                                        <span class="category-count">75</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Popular Tags -->
                    <div class="sidebar-widget tags-widget animate-on-scroll">
                        <div class="widget-header">
                            <h4><i class="fas fa-tags me-2"></i> Popular Tags</h4>
                        </div>
                        <div class="widget-content">
                            <div class="tags-list">
                                <a href="#" class="tag">AI</a>
                                <a href="#" class="tag">Startup</a>
                                <a href="#" class="tag">Web Development</a>
                                <a href="#" class="tag">Finance</a>
                                <a href="#" class="tag">Wellness</a>
                                <a href="#" class="tag">Productivity</a>
                                <a href="#" class="tag">Learning</a>
                                <a href="#" class="tag">Digital Marketing</a>
                                <a href="#" class="tag">Remote Work</a>
                                <a href="#" class="tag">Tech Trends</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Submission Section -->
    <section id="submit-blog" class="submit-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="submit-container animate-on-scroll">
                        <div class="submit-header text-center mb-5">
                            <h2 class="section-title">Submit Your Blog Post</h2>
                            <p class="text-muted">Share your knowledge with our community. Fill out the form below to submit your article.</p>
                        </div>
                        
                        <form action="#" method="POST" class="submit-form" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-4">
                                <!-- Blog Title -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="form-label">
                                            <i class="fas fa-heading me-2"></i> Blog Title *
                                        </label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter a compelling title for your blog post" required>
                                        <div class="form-text">Make it catchy and descriptive (60-70 characters recommended)</div>
                                    </div>
                                </div>
                                
                                <!-- Category -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="form-label">
                                            <i class="fas fa-folder me-2"></i> Category *
                                        </label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            <option value="technology">Technology</option>
                                            <option value="business">Business</option>
                                            <option value="lifestyle">Lifestyle</option>
                                            <option value="education">Education</option>
                                            <option value="health">Health & Wellness</option>
                                            <option value="travel">Travel</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Tags -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags" class="form-label">
                                            <i class="fas fa-tags me-2"></i> Tags
                                        </label>
                                        <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g., AI, startup, wellness (comma separated)">
                                        <div class="form-text">Add relevant keywords to help readers find your post</div>
                                    </div>
                                </div>
                                
                                <!-- Featured Image -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="featured_image" class="form-label">
                                            <i class="fas fa-image me-2"></i> Featured Image
                                        </label>
                                        <div class="image-upload-container">
                                            <div class="image-preview" id="imagePreview">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <p>Click to upload or drag and drop</p>
                                                <span>PNG, JPG or GIF (Max. 5MB)</span>
                                            </div>
                                            <input type="file" class="form-control d-none" id="featured_image" name="featured_image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content" class="form-label">
                                            <i class="fas fa-edit me-2"></i> Blog Content *
                                        </label>
                                        <textarea class="form-control" id="content" name="content" rows="12" placeholder="Write your blog content here..." required></textarea>
                                        <div class="form-text">Minimum 300 characters. Use proper formatting for better readability.</div>
                                    </div>
                                </div>
                                
                                <!-- Author Info -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author_name" class="form-label">
                                            <i class="fas fa-user me-2"></i> Your Name *
                                        </label>
                                        <input type="text" class="form-control" id="author_name" name="author_name" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="author_email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i> Email Address *
                                        </label>
                                        <input type="email" class="form-control" id="author_email" name="author_email" required>
                                    </div>
                                </div>
                                
                                <!-- Terms -->
                                <div class="col-md-12">
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-primary">Terms of Service</a> and confirm that this content is original and doesn't violate any copyrights.
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="col-md-12">
                                    <div class="submit-actions">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-paper-plane me-2"></i> Submit for Review
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-lg" id="saveDraft">
                                            <i class="fas fa-save me-2"></i> Save as Draft
                                        </button>
                                    </div>
                                    <p class="mt-3 text-muted small">
                                        <i class="fas fa-info-circle me-1"></i> Your submission will be reviewed by our editorial team. You'll receive an email notification once it's published.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="animate-on-scroll">Stay Updated</h2>
                    <p class="lead mb-4 animate-on-scroll">Subscribe to our newsletter and never miss an update. Get the latest articles delivered to your inbox.</p>
                    <div class="features-list">
                        <div class="feature-item animate-on-scroll">
                            <i class="fas fa-check-circle"></i>
                            <span>Weekly curated content</span>
                        </div>
                        <div class="feature-item animate-on-scroll">
                            <i class="fas fa-check-circle"></i>
                            <span>Exclusive articles</span>
                        </div>
                        <div class="feature-item animate-on-scroll">
                            <i class="fas fa-check-circle"></i>
                            <span>Industry insights</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="newsletter-form animate-on-scroll">
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" required>
                                    <option value="">Select interests</option>
                                    <option value="technology">Technology</option>
                                    <option value="business">Business</option>
                                    <option value="lifestyle">Lifestyle</option>
                                    <option value="education">Education</option>
                                    <option value="all">All Topics</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-light w-100"><i class="fas fa-paper-plane me-2"></i> Subscribe Now</button>
                            <p class="mt-3 small">By subscribing, you agree to our Privacy Policy and consent to receive updates.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-default-layout>