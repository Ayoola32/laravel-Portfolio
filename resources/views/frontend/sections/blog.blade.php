@if ($blogs->count())
    
<section class="blog-area section-padding-top" id="blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="section-title">
                    <h3 class="title">{{$blogSettings->title}}</h3>
                    <div class="desc">
                        <p>{!! $blogSettings->sub_title !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="blog-slider">
                    @foreach ($blogs as $blog)
                        
                    <div class="single-blog">
                        <figure class="blog-image">
                            <img src="{{asset($blog->image)}}" alt="">
                        </figure>
                        <div class="blog-content">
                            <h3 class="title"><a href="{{route('blog.details', $blog->slug)}}">{{$blog->title}}</a></h3>
                            <div class="desc">
                                <p>{{ Str::limit(strip_tags($blog->description), 150, '...') }}</p>
                            </div>
                            <a href="{{route('blog.details', $blog->slug)}}" class="button-primary-trans mouse-dir">Read More <span
                                    class="dir-part"></span> <i class="fal fa-arrow-right"></i></a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif