@extends('public.layout.app', ['title' => $hotel->title])

@section('meta')
  <meta name="description" content="{{htmlspecialchars($hotel->description)}}" />
  <meta name="keywords" content="{{htmlspecialchars($hotel->title)}}" />
  <meta property="og:title" content="{{$hotel->title}} "/>
  <meta property="og:type" content="{{$hotel->title}}"/>
  <meta property="og:image" content="{{($hotel->img)?asset('/storage/hotel/images/'.$hotel->img):asset('fontend/images/grid/1.jpg')}}"/>
@endsection

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Hotel</h1>
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
          <li class="list-group-item list-group-item-action">
            <div class="blog__img">
              <a href="#">
                <img src="{{($hotel->img)? asset('/storage/hotel/images/'.$hotel->img) : asset('backend/img/default.png')}}" alt="blog image">
              </a>
            </div><!-- /.entry-img -->
            <div class="blog__content">
              <div class="line-bottom"></div>
              <h4 class="blog__title">{{ $hotel->title }}</h4>
              <div class="blog__desc">
                {!!$hotel->description !!}
              </div><!-- /.blog-desc -->
            </div><!-- /.entry-content -->
          </li><!-- /.list-group -->
        </div><!-- /.blog-item -->

        <div class="blog-share">
          <h5 class="blog__share-title">Share This Content :</h5>
          <!-- <div class="social__icons"> -->
            <!-- <a href="#"><i class="fa fa-facebook"></i></a> -->
            <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
            <!-- <a href="#"><i class="fa fa-google-plus"></i></a> -->
            <!-- <a href="#"><i class="fa fa-linkedin"></i></a> -->
          <!-- </div> -->
          <div class="sharethis-inline-share-buttons" style="z-index:10"></div>
        </div><!-- /.blog-share -->

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
                    <div class="widget__post-content">
                      <span class="widget__post-date">{{\Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y')}}</span>
                      <h6 class="widget__post-title"><a href="{{route('public.agenda.detail',['slug'=>$list->slug])}}">{{$list->title}}</a></h6>
                    </div><!-- /.widget-post-content -->
                  </div><!-- /.widget-post-item -->
                @endforeach
              @else
                - Belum ada data -
              @endif
            </div><!-- /.widget-content -->
          </div><!-- /.widget-posts -->
          <div class="widget widget-posts">
            <h5 class="widget__title">Pengumuman Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($announcement) > 0)
                @foreach ($announcement as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{($list->img) ? asset('/storage/announcement/images/'.$list->img) : asset('backend/img/default.png')}}"></a>
                    </div><!-- /.widget-post-img -->
                    <div class="widget__post-content">
                      <span class="widget__post-date">{{\Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y')}}</span>
                      <h6 class="widget__post-title"><a href="{{route('public.announcement.detail',['slug'=>$list->slug])}}">{{$list->title}}</a></h6>
                    </div><!-- /.widget-post-content -->
                  </div><!-- /.widget-post-item -->
                @endforeach
              @else
                - Belum ada data -
              @endif
            </div><!-- /.widget-content -->
          </div><!-- /.widget-posts -->
          <div class="widget widget-posts">
            <h5 class="widget__title">Artikel Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($article) > 0)
                @foreach ($article as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{($list->img) ? asset('/storage/article/images/'.$list->img) : asset('backend/img/default.png')}}"></a>
                    </div><!-- /.widget-post-img -->
                    <div class="widget__post-content">
                      <span class="widget__post-date">{{\Carbon\Carbon::parse($list->created_at)->translatedFormat('d F Y')}}</span>
                      <h6 class="widget__post-title"><a href="{{route('public.article.detail',['slug'=>$list->slug])}}">{{$list->title}}</a></h6>
                    </div><!-- /.widget-post-content -->
                  </div><!-- /.widget-post-item -->
                @endforeach
              @else
                - Belum ada data -
              @endif
            </div><!-- /.widget-content -->
          </div><!-- /.widget-posts -->
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
