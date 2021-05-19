@extends('public.layout.app', ['title' => $album->title])

@section('meta')
  <meta name="description" content="{{htmlspecialchars($album->short_description)}}" />
  <meta name="keywords" content="{{htmlspecialchars($album->title)}}" />
  <meta property="og:title" content="{{$album->title}} "/>
  <meta property="og:type" content="{{$album->title}}"/>
  <meta property="og:image" content="{{($album->img)?asset('/storage/article/images/'.$album->img):asset('fontend/images/grid/1.jpg')}}"/>
@endsection

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">{{$album->title}}</h1>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

<!-- === List Foto === -->
<section id="blogSingleRightSidebar" class="blog blog-single pb-60" style="padding:60px 0;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-8">
        <div id="filtered-items-wrap" class="row gallery-box mb-50">
          <!-- get item -->
          @foreach($foto as $pic)
          <div class="col-sm-6 col-md-6 col-lg-4 mix filter-packaging">
            <div class="project-item">
              <div class="project__img">
                <img width="auto" height="250px" src="{{asset('/storage/gallery/photo/images/'.$pic->img)}}" alt="{{$pic->name}}">
                <div class="project__hover">
                  <div class="hover__content">
                    <div class="hover__content-inner">
                      <h5 class="project__title"><a href="{{asset('/storage/gallery/photo/images/'.$pic->img)}}" data-caption="{{$pic->description}}">{{$pic->name}}</a></h5>
                    </div>
                  </div><!-- /.hover-content -->
                </div><!-- /.project-hover -->
              </div><!-- /.project-img -->
            </div><!-- /.project-item -->
          </div><!-- /.col-lg-4 -->
          @endforeach
        </div><!-- /.row -->
      </div><!-- /.col-lg-9 -->

      <div class="col-sm-12 col-md-12 col-lg-4">
        <aside class="sidebar sidebar-wide">
          <div class="widget widget-posts">
            <h5 class="widget__title">Artikel Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($article) > 0)
                @foreach ($article as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{asset('/storage/article/images/'.$list->img)}}"></a>
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
          <div class="widget widget-posts">
            <h5 class="widget__title">Agenda Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($agenda) > 0)
                @foreach ($agenda as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{asset('/storage/agenda/images/'.$list->img)}}"></a>
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
          <div class="widget widget-posts">
            <h5 class="widget__title">Pengumuman Terbaru</h5>
            <div class="widget__content">
              <!-- post item -->
              @if(count($announcement) > 0)
                @foreach ($announcement as $list)
                  <div class="widget-post-item">
                    <div class="widget__post-img">
                      <a href="#"><img src="{{asset('/storage/announcement/images/'.$list->img)}}"></a>
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
        </aside><!-- /.sidebar -->
      </div><!-- /.col-lg-4 -->

    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.blog Single -->
@endsection

@section('top-resource')
<link rel="stylesheet" href="{{asset('frontend/css/baguetteBox.min.css')}}">
@endsection
@section('bottom-resource')
<script src="{{asset('frontend/js/baguetteBox.min.js')}}" charset="utf-8"></script>
<script type="text/javascript">
  baguetteBox.run('.gallery-box', {
  captions: true, // display image captions.
  buttons: 'auto', // arrows navigation
  fullScreen: false,
  noScrollbars: false,
  bodyClass: 'baguetteBox-open',
  titleTag: false,
  async: false,
  preload: 2,
  animation: 'slideIn', // fadeIn or slideIn
  verlayBackgroundColor: 'rgba(0,0,0,.8)'
  });
</script>
@endsection
