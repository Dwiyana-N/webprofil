@extends('public.layout.app', ['title' => $article->title])

@section('meta')
  <meta name="description" content="{{htmlspecialchars($article->short_description)}}" />
  <meta name="keywords" content="{{htmlspecialchars($article->title)}}" />
  <meta property="og:title" content="{{$article->title}} "/>
  <meta property="og:type" content="{{$article->title}}"/>
  <meta property="og:image" content="{{($article->img)?asset('/storage/article/images/'.$article->img):asset('fontend/images/grid/1.jpg')}}"/>
@endsection

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Artikel</h1>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

<!-- === Blog Single === -->
<section id="blogSingleRightSidebar" class="blog blog-single pb-60">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-8">
        <div class="blog-item blog-single-item">
          <div class="blog__img">
            <a href="#">
              <img src="{{($article->img)? asset('/storage/article/images/'.$article->img) : asset('backend/img/default.png')}}" alt="blog image">
            </a>
          </div><!-- /.entry-img -->
          <div class="blog__content">
            <div class="blog__meta">
              <div class="blog__meta-cat">
                <a href="#">{{$article->category->name}}</a>
              </div><!-- /.blog-meta-cat --><br>
              <span class="blog__meta-date">
                <i class="fa fa-user"></i> {{$article->created_by}} |
                <i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($article->created_at)->translatedFormat('l, d F Y')}} |
                <i class="fa fa-eye"></i> {{$article->hit}}
              </span>
            </div><!-- /.blog-meta -->
            <div class="line-bottom"></div>
            <h4 class="blog__title">{{$article->title}}</h4>
            <div class="blog__desc">
              {!!$article->content !!}
            </div><!-- /.blog-desc -->
          </div><!-- /.entry-content -->
        </div><!-- /.blog-item -->
        <div class="widget widget-tags">
          <div class="widget-content">
            <ul class="list-unstyled">
              @foreach($article->tags as $list)
              <li><a href="#"><i class="fa fa-tag"></i> {{$list->name}}</a></li>
              @endforeach
            </ul>
          </div>
        </div><!-- /.widget-content -->
        <div class="blog-share">
          <h5 class="blog__share-title">Share This Article :</h5>
          <!-- <div class="social__icons"> -->
            <!-- <a href="#"><i class="fa fa-facebook"></i></a> -->
            <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
            <!-- <a href="#"><i class="fa fa-google-plus"></i></a> -->
            <!-- <a href="#"><i class="fa fa-linkedin"></i></a> -->
          <!-- </div> -->
          <div class="sharethis-inline-share-buttons" style="z-index:10"></div>
        </div><!-- /.blog-share -->
        {{-- <div class="related-posts">
          <h5 class="blog__widget-title">related posts</h5>
          <div class="row">
            <!-- Blog Item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="blog-item">
                <div class="blog__img">
                  <a href="#">
                    <img src="assets/images/blog/grid/2.jpg" alt="blog image">
                  </a>
                </div><!-- /.entry-img -->
                <div class="blog__content">
                  <div class="blog__meta">
                    <div class="blog__meta-cat">
                      <a href="#">Modern</a><a href="#">Photography</a>
                    </div><!-- /.blog-meta-cat -->
                    <span class="blog__meta-date">Oct 18, 2017</span>
                  </div><!-- /.blog-meta -->
                  <h4 class="blog__title"><a href="#">Old cameras can capture images better</a>
                  </h4>
                </div><!-- /.entry-content -->
              </div><!-- /.blog-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="blog-item">
                <div class="blog__img">
                  <a href="#">
                    <img src="assets/images/blog/grid/3.jpg" alt="blog image">
                  </a>
                </div><!-- /.entry-img -->
                <div class="blog__content">
                  <div class="blog__meta">
                    <div class="blog__meta-cat">
                      <a href="#">Technology</a><a href="#">City</a>
                    </div><!-- /.blog-meta-cat -->
                    <span class="blog__meta-date">Jan 20, 2019</span>
                  </div><!-- /.blog-meta -->
                  <h4 class="blog__title"><a href="#">New subway line has the most advanced tech</a>
                  </h4>
                </div><!-- /.entry-content -->
              </div><!-- /.blog-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Blog Item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="blog-item">
                <div class="blog__img">
                  <a href="#">
                    <img src="assets/images/blog/grid/4.jpg" alt="blog image">
                  </a>
                </div><!-- /.entry-img -->
                <div class="blog__content">
                  <div class="blog__meta">
                    <div class="blog__meta-cat">
                      <a href="#">Business</a><a href="#">Tips</a>
                    </div><!-- /.blog-meta-cat -->
                    <span class="blog__meta-date">Jan 20, 2019</span>
                  </div><!-- /.blog-meta -->
                  <h4 class="blog__title"><a href="#">7 Signs You’re Not A Good UX Designer Yet!</a></h4>
                </div><!-- /.entry-content -->
              </div><!-- /.blog-item -->
            </div><!-- /.col-lg-4 -->
          </div><!-- /.row -->
        </div><!-- /.related-posts --> --}}

        <div class="blog-widget blog-comments">
          <h5 class="blog__widget-title">Komentar</h5>
          <ul class="comments-list">
            @if(count($comment)<1)
              <span> - Belum ada komentar - </span>
            @else
            @foreach($comment as $text)
            <li class="comment__item">
              <div class="comment__avatar">
                <img src="{{asset('frontend/images/blog/author/3.jpg')}}" alt="avatar">
              </div>
              <div class="comment__content">
                <h6 class="comment__author">{{$text->name}}</h6>
                <span class="comment__date">{{\Carbon\Carbon::parse($text->created_at)->translatedFormat('d F Y h:i:s')}}</span>
                <p class="comment__desc">{!! $text->comment !!}</p>
                {{-- <a class="comment__reply" href="#">reply</a> --}}
              </div>
              @if(!empty($text->reply))
              <ul class="nested__comment">
                <li class="comment__item">
                  <div class="comment__avatar">
                    <img src="{{asset('frontend/images/blog/author/1.jpg')}}" alt="avatar">
                  </div>
                  <div class="comment__content">
                    <h6 class="comment__author">{{$text->author}}</h6>
                    <span class="comment__date">{{\Carbon\Carbon::parse($text->created_at)->translatedFormat('d F Y h:i:s')}}</span>
                    <p class="comment__desc">{!! $text->reply !!}</p>
                  </div>
                </li><!-- /.comment -->
              </ul><!-- /.nested-comment -->
              @else
                <span></span>
              @endif
            </li><!-- /.comment -->
            @endforeach
            @endif
          </ul><!-- /.comments-list -->
        </div><!-- /.blog-comments -->
        <div class="blog-widget blog-comments-form">
          <h5 class="blog__widget-title">Tinggalkan Komentar</h5>
          <form method="POST" action="{{route('public.article.comment')}}">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Nama:" required>
                </div><!-- /.form-group -->
              </div><!-- /.col-lg-6 -->
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email:" required>
                </div><!-- /.form-group -->
              </div><!-- /.col-lg-6 -->
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <textarea class="form-control" name="comment" placeholder="Komentar..." required></textarea>
                </div><!-- /.form-group -->
              </div><!-- /.col-lg-12 -->
              <div class="col-sm-12 col-md-12 col-lg-12">
                <button type="submit" class="btn btn__primary">Submit</button>
              </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
          </form>
        </div><!-- /.blog-comments-form -->
      </div><!-- /.col-lg-9 -->

      <div class="col-sm-12 col-md-12 col-lg-4">
        <aside class="sidebar sidebar-wide">
          <div class="widget widget-posts">
            <h5 class="widget__title">Agenda Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($agenda) > 0)
                @foreach ($agenda as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{($list->img)? asset('/storage/agenda/images/'.$list->img) : asset('backend/img/default.png')}}"></a>
                    </div><!-- /.widget-post-img -->
                    <div class="widget__post-content">
                      <span class="widget__post-date">{{\Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y')}}</span>
                      <h6 class="widget__post-title"><a href="#">{{$list->title}}</a></h6>
                    </div><!-- /.widget-post-content -->
                  </div><!-- /.widget-post-item -->
                @endforeach
              @else
                - Belum ada data -
              @endif
            </div><!-- /.widget-content -->
          </div><!-- /.widget-posts -->
          <div class="widget widget-categories">
            <h5 class="widget__title">categories</h5>
            <div class="widget-content">
              <ul class="list-unstyled">
                @foreach($category as $list)
                <li><a href="#"><strong>{{$list->name}}</strong></a></li>
                @endforeach
              </ul>
            </div><!-- /.widget-content -->
          </div><!-- /.widget-categories -->
          <div class="widget widget-tags">
            <h5 class="widget__title">Tags</h5>
            <div class="widget-content">
              <ul class="list-unstyled">
                @foreach($tags as $list)
                <li><a href="#">{{$list->name}}</a></li>
                @endforeach
              </ul>
            </div><!-- /.widget-content -->
          </div><!-- /.widget-Tags -->
        </aside><!-- /.sidebar -->
      </div><!-- /.col-lg-4 -->

</div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.blog Single -->
@endsection

@section('top-resource')
@endsection
@section('bottom-resource')
@endsection
