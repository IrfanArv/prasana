@extends('layouts.app')
@section('meta_title', $post->meta_title ?? $post->title)
@section('meta_desc', $post->meta_desc ?? $post->excerpt)
@section('meta_keyword', $post->meta_keyword ?? '')
@section('meta_image', $post->cover_image ? asset('/img/blog/' . $post->cover_image) : asset('img/whitelogo.svg'))
@section('title', $post->title . ' - ')
@section('content')
    <style>
        .blog-detail-header { position: relative; height: 450px; overflow: hidden; }
        .blog-detail-header img { width: 100%; height: 100%; object-fit: cover; }
        .blog-detail-header::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 150px; background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent); z-index: 2; pointer-events: none; }
        .blog-detail-header-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 40px; background: linear-gradient(transparent, rgba(0,0,0,0.8)); color: #fff; z-index: 2; }
        .blog-detail-header-overlay .blog-tag { display: inline-block; background: #A58639; color: #fff; padding: 4px 12px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; margin-right: 5px; text-decoration: none; border-radius: 3px; }
        .blog-detail-header-overlay h1 { font-size: 32px; font-weight: 700; margin-bottom: 10px; }
        .blog-detail-meta { font-size: 13px; color: #ddd; }
        .blog-detail-meta span { margin-right: 15px; }

        .blog-detail-content { font-size: 15px; line-height: 1.8; color: #444; }
        .blog-detail-content img { max-width: 100%; height: auto; margin: 15px 0; }
        .blog-detail-content h2, .blog-detail-content h3 { color: #333; margin-top: 25px; }

        .blog-detail-tags { margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; }
        .blog-detail-tags a { display: inline-block; padding: 6px 14px; border: none; border-radius: 20px; font-size: 12px; color: #666; text-decoration: none; margin-right: 5px; margin-bottom: 5px; transition: all 0.3s; background: #f3f3f3; font-weight: 500; }
        .blog-detail-tags a:hover { background: #A58639; color: #fff; }

        .blog-gallery { margin: 30px 0; }
        .blog-gallery img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }

        .related-posts .blog-card .card-img { overflow: hidden; border-radius: 8px; }
        .related-posts .blog-card .card-img img { height: 180px; width: 100%; object-fit: cover; transition: transform 0.5s; }
        .related-posts .blog-card:hover .card-img img { transform: scale(1.05); }
        .related-posts .blog-card .card-title { font-size: 15px; }
        .related-posts .blog-card .card-title a { color: #222; text-decoration: none; transition: color 0.3s; }
        .related-posts .blog-card .card-title a:hover { color: #A58639; }

        .blog-sidebar .sidebar-widget { margin-bottom: 25px; padding: 0; background: transparent; }
        .blog-sidebar .sidebar-widget h4 { font-size: 13px; text-transform: uppercase; letter-spacing: 2px; color: #A58639; font-weight: 700; margin-bottom: 18px; padding-bottom: 10px; border-bottom: 2px solid #A58639; }
        .blog-sidebar .category-list { list-style: none; padding: 0; margin: 0; }
        .blog-sidebar .category-list li { padding: 0; border-bottom: none; }
        .blog-sidebar .category-list li a { color: #555; text-decoration: none; font-size: 14px; display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; border-radius: 6px; transition: all 0.25s; }
        .blog-sidebar .category-list li a:hover { background: rgba(165,134,57,0.08); color: #A58639; padding-left: 18px; }
        .blog-sidebar .category-list li a span { font-size: 12px; color: #aaa; background: #f0f0f0; padding: 2px 8px; border-radius: 10px; }
        .blog-sidebar .category-list li a:hover span { background: rgba(165,134,57,0.15); color: #A58639; }
        .blog-sidebar .tag-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
        .blog-sidebar .tag-cloud a { display: inline-block; padding: 6px 14px; border: none; border-radius: 20px; font-size: 12px; color: #666; text-decoration: none; transition: all 0.3s; background: #f3f3f3; font-weight: 500; }
        .blog-sidebar .tag-cloud a:hover { background: #A58639; color: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(165,134,57,0.3); }

        @media (max-width: 768px) {
            .blog-detail-header { height: 300px; }
            .blog-detail-header-overlay h1 { font-size: 22px; }
        }
    </style>

    {{-- HEADER IMAGE --}}
    <div class="blog-detail-header">
        @if($post->cover_image)
            <img src="{{ asset('/img/blog/' . $post->cover_image) }}" alt="{{ $post->title }}">
        @endif
        <div class="blog-detail-header-overlay">
            @foreach($post->categories as $cat)
                <a href="{{ route('blog.category', $cat->slug) }}" class="blog-tag">{{ $cat->name }}</a>
            @endforeach
            <h1>{{ $post->title }}</h1>
            <div class="blog-detail-meta">
                <span><i class="far fa-user"></i> {{ $post->author->name ?? 'Admin' }}</span>
                <span><i class="far fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-detail-content">
                    {!! $post->content !!}
                </div>

                {{-- Gallery --}}
                @if($post->getMedia('photo')->count() > 0)
                <div class="blog-gallery">
                    <div class="row">
                        @foreach($post->getMedia('photo') as $media)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($media->getUrl()) }}" alt="{{ $post->title }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tags --}}
                @if($post->tags->count() > 0)
                <div class="blog-detail-tags">
                    <strong>Tags:</strong>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('blog.tag', $tag->slug) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
                @endif

                {{-- Related Posts --}}
                @if($relatedPosts->count() > 0)
                <div class="related-posts mt-5">
                    <h3 class="mb-4" style="font-size: 14px; text-transform: uppercase; letter-spacing: 3px; color: #333; font-weight: 700;">Related Posts</h3>
                    <div class="row">
                        @foreach($relatedPosts as $related)
                        <div class="col-md-4 mb-4">
                            <div class="blog-card">
                                <div class="card-img">
                                    <a href="{{ route('blog.detail', $related->slug) }}">
                                        <img src="{{ $related->cover_image ? asset('/img/blog/' . $related->cover_image) : 'https://dummyimage.com/400x180/eee/999&text=No+Cover' }}" alt="{{ $related->title }}">
                                    </a>
                                </div>
                                <div class="card-body" style="padding: 10px 0;">
                                    <h5 class="card-title"><a href="{{ route('blog.detail', $related->slug) }}">{{ $related->title }}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div class="col-md-4">
                <div class="blog-sidebar">
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
