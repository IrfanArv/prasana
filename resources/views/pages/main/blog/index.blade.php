@extends('layouts.app')
@section('meta_title', isset($pageTitle) ? $pageTitle . ' - Prasana by Arjani Resorts' : 'Blog - Prasana by Arjani Resorts')
@section('meta_desc', 'Latest news, stories and updates from Prasana by Arjani Resorts')
@section('meta_keyword', 'prasana blog, bali resort blog, arjani resorts news')
@section('title', isset($pageTitle) ? $pageTitle . ' - ' : 'Blog - ')
@section('content')
    <style>
        /* Hero Banner */
        .blog-page-hero {
            position: relative;
            height: 350px;
            background: linear-gradient(135deg, #3d2e0f 0%, #6b4f1d 40%, #a58639 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }
        .blog-page-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('{{ asset("/img/blog-hero-pattern.png") }}') center/cover no-repeat;
            opacity: 0.1;
        }
        .blog-page-hero .hero-content {
            position: relative;
            z-index: 2;
            color: #fff;
        }
        .blog-page-hero .hero-content h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .blog-page-hero .hero-content .hero-divider {
            width: 60px;
            height: 3px;
            background: #A58639;
            margin: 15px auto;
        }
        .blog-page-hero .hero-content p {
            font-size: 15px;
            color: rgba(255,255,255,0.7);
            max-width: 500px;
            margin: 0 auto;
        }

        /* Featured Grid */
        .blog-featured-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 10px; }
        .blog-featured-item { position: relative; overflow: hidden; border-radius: 8px; }
        .blog-featured-item img { width: 100%; height: 400px; object-fit: cover; transition: transform 0.5s ease; }
        .blog-featured-item:hover img { transform: scale(1.05); }
        .blog-featured-item::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(transparent 40%, rgba(0,0,0,0.8)); z-index: 2; pointer-events: none; }
        .blog-featured-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 25px; color: #fff; z-index: 3; }
        .blog-featured-overlay .blog-tag { display: inline-block; background: #A58639; color: #fff; padding: 3px 10px; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; margin-right: 4px; text-decoration: none; border-radius: 3px; }
        .blog-featured-overlay .blog-date { font-size: 12px; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
        .blog-featured-overlay h3 { font-size: 20px; font-weight: 700; margin: 0; }
        .blog-featured-overlay h3 a { color: #fff; text-decoration: none; }

        /* Section Title */
        .section-title { font-size: 14px; text-transform: uppercase; letter-spacing: 3px; color: #333; font-weight: 700; margin-bottom: 30px; position: relative; }
        .section-title::after { content: ''; width: 50px; height: 2px; background: #A58639; display: block; margin-top: 10px; }

        /* Blog Card */
        .blog-card { margin-bottom: 30px; }
        .blog-card .card-img { overflow: hidden; position: relative; border-radius: 8px; }
        .blog-card .card-img img { width: 100%; height: 220px; object-fit: cover; transition: transform 0.5s ease; }
        .blog-card:hover .card-img img { transform: scale(1.05); }
        .blog-card .card-body { padding: 15px 0; }
        .blog-card .blog-tag { display: inline-block; background: rgba(165,134,57,0.12); color: #A58639; padding: 3px 10px; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; text-decoration: none; border-radius: 3px; font-weight: 600; }
        .blog-card .blog-tag:hover { background: #A58639; color: #fff; }
        .blog-card .card-title { font-size: 16px; font-weight: 700; color: #222; }
        .blog-card .card-title a { color: #222; text-decoration: none; transition: color 0.3s; }
        .blog-card .card-title a:hover { color: #A58639; }
        .blog-card .card-text { font-size: 13px; color: #666; line-height: 1.6; }

        /* Sidebar */
        .blog-sidebar .sidebar-widget { margin-bottom: 25px; padding: 0; background: transparent; }
        .blog-sidebar .sidebar-widget h4 { font-size: 13px; text-transform: uppercase; letter-spacing: 2px; color: #A58639; font-weight: 700; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #A58639; }
        .blog-sidebar .search-form { position: relative; }
        .blog-sidebar .search-form input { width: 100%; padding: 12px 50px 12px 18px; border: 1px solid #e0e0e0; border-radius: 25px; font-size: 13px; background: #fafafa; outline: none; transition: border-color 0.3s, box-shadow 0.3s; }
        .blog-sidebar .search-form input:focus { border-color: #A58639; box-shadow: 0 0 0 3px rgba(165,134,57,0.15); }
        .blog-sidebar .search-form button { position: absolute; right: 5px; top: 5px; bottom: 5px; background: #A58639; color: #fff; border: none; padding: 0 16px; cursor: pointer; border-radius: 20px; transition: background 0.3s; }
        .blog-sidebar .search-form button:hover { background: #8a6f2e; }
        .blog-sidebar .category-list { list-style: none; padding: 0; margin: 0; }
        .blog-sidebar .category-list li { padding: 0; border-bottom: none; }
        .blog-sidebar .category-list li a { color: #555; text-decoration: none; font-size: 14px; display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; border-radius: 6px; transition: all 0.25s; }
        .blog-sidebar .category-list li a:hover { background: rgba(165,134,57,0.08); color: #A58639; padding-left: 18px; }
        .blog-sidebar .category-list li a span { font-size: 12px; color: #aaa; background: #f0f0f0; padding: 2px 8px; border-radius: 10px; }
        .blog-sidebar .category-list li a:hover span { background: rgba(165,134,57,0.15); color: #A58639; }
        .blog-sidebar .tag-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
        .blog-sidebar .tag-cloud a { display: inline-block; padding: 6px 14px; border: none; border-radius: 20px; font-size: 12px; color: #666; text-decoration: none; transition: all 0.3s; background: #f3f3f3; font-weight: 500; }
        .blog-sidebar .tag-cloud a:hover { background: #A58639; color: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(165,134,57,0.3); }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-state .empty-icon {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }
        .empty-state h4 {
            font-size: 18px;
            font-weight: 600;
            color: #999;
            margin-bottom: 8px;
        }
        .empty-state p {
            font-size: 14px;
            color: #bbb;
            max-width: 400px;
            margin: 0 auto;
        }
        .empty-state .btn-browse {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 24px;
            background: #A58639;
            color: #fff;
            text-decoration: none;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .empty-state .btn-browse:hover {
            background: #8a6f2e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(165,134,57,0.3);
        }

        /* Featured Carousel */
        .featured-carousel { position: relative; }

        @media (max-width: 768px) {
            .blog-page-hero { height: 250px; }
            .blog-page-hero .hero-content h1 { font-size: 28px; }
            .blog-featured-grid { grid-template-columns: 1fr; }
            .blog-featured-item img { height: 280px; }
        }
    </style>

    {{-- HERO BANNER (only for category/tag/search pages) --}}
    @if(isset($pageTitle))
    <div class="blog-page-hero">
        <div class="hero-content">
            <h1>{{ $pageTitle }}</h1>
            <div class="hero-divider"></div>
            <p>{{ $pageSubtitle }}</p>
        </div>
    </div>
    @endif

    {{-- FEATURED GRID (only when there are 2+ featured posts) --}}
    @if($featuredPosts->count() >= 2)
    <div class="container my-5">
        <div class="blog-featured-grid">
            <div class="blog-featured-item">
                <a href="{{ route('blog.detail', $featuredPosts[0]->slug) }}">
                    <img src="{{ $featuredPosts[0]->cover_image ? asset('/img/blog/' . $featuredPosts[0]->cover_image) : 'https://dummyimage.com/800x400/333/aaa&text=No+Cover' }}" alt="{{ $featuredPosts[0]->title }}">
                </a>
                <div class="blog-featured-overlay">
                    @foreach($featuredPosts[0]->categories->take(2) as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
                    @endforeach
                    <div class="blog-date">{{ $featuredPosts[0]->created_at->format('M d, Y') }}</div>
                    <h3><a href="{{ route('blog.detail', $featuredPosts[0]->slug) }}">{{ $featuredPosts[0]->title }}</a></h3>
                </div>
            </div>
            <div class="blog-featured-item">
                <a href="{{ route('blog.detail', $featuredPosts[1]->slug) }}">
                    <img src="{{ $featuredPosts[1]->cover_image ? asset('/img/blog/' . $featuredPosts[1]->cover_image) : 'https://dummyimage.com/800x400/333/aaa&text=No+Cover' }}" alt="{{ $featuredPosts[1]->title }}">
                </a>
                <div class="blog-featured-overlay">
                    @foreach($featuredPosts[1]->categories->take(2) as $cat)
                        <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
                    @endforeach
                    <div class="blog-date">{{ $featuredPosts[1]->created_at->format('M d, Y') }}</div>
                    <h3><a href="{{ route('blog.detail', $featuredPosts[1]->slug) }}">{{ $featuredPosts[1]->title }}</a></h3>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FEATURED CAROUSEL (only when there are featured posts) --}}
    @if($featuredPosts->count() > 0)
    <div class="container my-5">
        <h3 class="section-title">Featured Articles</h3>
        <div class="featured-carousel">
            <div class="row featured-slider">
                @foreach($featuredPosts as $post)
                <div class="col-md-3">
                    <div class="blog-card">
                        <div class="card-img">
                            <a href="{{ route('blog.detail', $post->slug) }}">
                                <img src="{{ $post->cover_image ? asset('/img/blog/' . $post->cover_image) : 'https://dummyimage.com/400x220/eee/999&text=No+Cover' }}" alt="{{ $post->title }}">
                            </a>
                        </div>
                        <div class="card-body">
                            @foreach($post->categories->take(2) as $cat)
                                <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
                            @endforeach
                            <h5 class="card-title"><a href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a></h5>
                            <p class="card-text">{{ Str::limit($post->excerpt, 100) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- RECENT NEWS + SIDEBAR --}}
    <div class="container my-5">
        <h3 class="section-title">{{ $sectionTitle ?? 'Recent News' }}</h3>
        <div class="row">
            <div class="col-md-8">
                @if($recentPosts->count() > 0)
                    <div class="row">
                        @foreach($recentPosts as $key => $post)
                            @if($key === 0)
                                <div class="col-12 mb-4">
                                    <div class="blog-card">
                                        <div class="card-img">
                                            <a href="{{ route('blog.detail', $post->slug) }}">
                                                <img src="{{ $post->cover_image ? asset('/img/blog/' . $post->cover_image) : 'https://dummyimage.com/800x350/eee/999&text=No+Cover' }}" alt="{{ $post->title }}" style="height: 350px;">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            @foreach($post->categories->take(2) as $cat)
                                                <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
                                            @endforeach
                                            <h5 class="card-title"><a href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a></h5>
                                            <p class="card-text">{{ Str::limit($post->excerpt, 150) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6 mb-4">
                                    <div class="blog-card">
                                        <div class="card-img">
                                            <a href="{{ route('blog.detail', $post->slug) }}">
                                                <img src="{{ $post->cover_image ? asset('/img/blog/' . $post->cover_image) : 'https://dummyimage.com/400x220/eee/999&text=No+Cover' }}" alt="{{ $post->title }}">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            @foreach($post->categories->take(2) as $cat)
                                                <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
                                            @endforeach
                                            <h5 class="card-title"><a href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a></h5>
                                            <p class="card-text">{{ Str::limit($post->excerpt, 80) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="text-center my-4">
                        {!! $recentPosts->links() !!}
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h4>No posts yet</h4>
                        <p>{{ $emptyMessage ?? 'We\'re working on some great content. Check back soon for the latest stories and updates!' }}</p>
                        @if(isset($pageTitle))
                            <a href="{{ url('/blog') }}" class="btn-browse">Browse All Posts</a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div class="col-md-4">
                <div class="blog-sidebar">
                    {{-- Search --}}
                    <div class="sidebar-widget">
                        <form action="{{ route('blog.search') }}" method="GET" class="search-form">
                            <input type="text" name="q" placeholder="Search articles..." value="{{ request('q') }}">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>

                    {{-- Categories --}}
                    @if($categories->count() > 0)
                    <div class="sidebar-widget">
                        <h4>Categories</h4>
                        <ul class="category-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.category', $cat->slug) }}">
                                        {{ $cat->name }}
                                        <span>({{ $cat->posts_count }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Tags --}}
                    @if($tags->count() > 0)
                    <div class="sidebar-widget">
                        <h4>Tags</h4>
                        <div class="tag-cloud">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            // Force white header on blog pages (no hero image to overlay)
            var myNav = document.getElementById('header');
            myNav.classList.add('bg-white');
            myNav.classList.remove('bg-transparent');
            document.getElementById('logoimage').src = '/public/img/blacklogo.svg';
            var links = document.querySelectorAll('a.nav-link');
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                links.forEach(function(link) { link.style.color = '#ffffff'; });
            } else {
                links.forEach(function(link) { link.style.color = '#828282'; });
            }
            var burger1 = document.getElementById('burger1');
            var burger2 = document.getElementById('burger2');
            var burger3 = document.getElementById('burger3');
            if (burger1) { burger1.classList.add('color-nav-dark'); burger1.classList.remove('color-nav-white'); }
            if (burger2) { burger2.classList.add('color-nav-dark'); burger2.classList.remove('color-nav-white'); }
            if (burger3) { burger3.classList.add('color-nav-dark'); burger3.classList.remove('color-nav-white'); }

            // Slick carousel
            if ($('.featured-slider').length && $('.featured-slider').children().length > 0) {
                $('.featured-slider').slick({
                    dots: true,
                    infinite: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    responsive: [{
                        breakpoint: 992,
                        settings: { slidesToShow: 2 }
                    }, {
                        breakpoint: 480,
                        settings: { slidesToShow: 1 }
                    }]
                });
            }
        });
    </script>
@endpush

