@extends('frontend.layouts.layout')
@section('content')
    <header class="site-header parallax-bg">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-sm-8">
                    <h2 class="title">Blog Details</h2>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio-Area-Start -->
    <section class="blog-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="head-title">{{ $blog->title }}</h2>
                    <div class="blog-meta">
                        <div class="single-meta">
                            <div class="meta-title">Published</div>
                            <h4 class="meta-value"><a
                                    href="javascript:void(0)">{{ date('d M, Y', strtotime($blog->created_at)) }}</a></h4>
                        </div>
                        <div class="single-meta">
                            <div class="meta-title">Category</div>
                            <h4 class="meta-value"><a href="{{ route('blog.category', $blog->category->slug) }}">{{ $blog->category->name }}</a></h4>
                        </div>
                    </div>
                    <figure class="image-block">
                        <img class="img-fix" src="{{ asset($blog->image) }}" alt="">
                    </figure>
                    <div class="description">
                        {!! $blog->description !!}
                    </div>

                    <div class="related-posts-wrapper">
                        @if ($nextPost || $previousPost)
                            <div class="related-posts-label">Related Posts</div>
                        @endif
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <div class="blog-slider">
                                @if ($previousPost)
                                    <div class="single-blog">
                                        <figure class="blog-image">
                                            <img src="{{ asset($previousPost->image) }}" alt="">
                                        </figure>
                                        <div class="blog-content">
                                            <h3 class="title"><span class="icon"><i class="fal fa-angle-left"></i></span>
                                                <a
                                                    href="{{ route('blog.details', $previousPost->slug) }}">{{ $previousPost->title }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                @endif

                                @if ($nextPost)
                                    <div class="single-blog">
                                        <figure class="blog-image">
                                            <img src="{{ asset($nextPost->image) }}" alt="">
                                        </figure>
                                        <div class="blog-content">
                                            <h3 class="title"><span class="icon"><i
                                                        class="fal fa-angle-right"></i></span>
                                                <a href="{{ route('blog.details', $nextPost->slug) }}">
                                                    {{ $nextPost->title }}
                                                    <span class="icon"><i class="fal fa-angle-right"></i></span>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="categories-section">
                        @if ($blogCategories)
                            
                        <h3 class="categories-title">Categories</h3>
                        <div class="categories-list d-flex flex-wrap">
                            @foreach ($blogCategories as $blogCategory)
                                <a href="{{ route('blog.category', $blogCategory->slug) }}" class="nav-link mx-2">
                                    <span class="text">{{ $blogCategory->name }}</span>
                                </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>


            </div>

        </div>
    </section>

@endsection
