@extends('public.layout.app', ['title' => $agenda->title])

@section('meta')
  <meta name="description" content="{{htmlspecialchars($agenda->description)}}" />
  <meta name="keywords" content="{{htmlspecialchars($agenda->title)}}" />
  <meta property="og:title" content="{{$agenda->title}} "/>
  <meta property="og:type" content="{{$agenda->title}}"/>
  <meta property="og:image" content="{{($agenda->img)?asset('/storage/agenda/images/'.$agenda->img):asset('fontend/images/grid/1.jpg')}}"/>
@endsection

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Agenda</h1>
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
              <img src="{{($agenda->img)? asset('/storage/agenda/images/'.$agenda->img) : asset('backend/img/default.png')}}" alt="blog image">
            </a>
          </div><!-- /.entry-img -->
          <div class="blog__content">
            <div class="blog__meta">
              <div class="blog__meta-cat">
              </div><!-- /.blog-meta-cat --><br>
              <span class="blog__meta-date">
                <i class="fa fa-user"></i> {{$agenda->created_by}} |
                <i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($agenda->created_at)->translatedFormat('l, d F Y')}} |
                <i class="fa fa-eye"></i> {{$agenda->hit}}
              </span>
            </div><!-- /.blog-meta -->
            <div class="line-bottom"></div>
            <h4 class="blog__title">{{$agenda->title}}</h4>
            <div class="blog__desc">
              <p>
                <table>
                  <tr>
                    <td style="padding-left:5px;padding-right:5px;"><i class="fa fa-map-marker"></i></td>
                    <td style="padding-left:5px;padding-right:5px;">Lokasi</td>
                    <td style="padding-left:5px;padding-right:5px;"> : </td>
                    <td style="padding-left:5px;padding-right:5px;">{{$agenda->location}}</td>
                  </tr>
                  <tr>
                    <td style="padding-left:5px;padding-right:5px;"><i class="fa fa-clock-o"></i></td>
                    <td style="padding-left:5px;padding-right:5px;">Jam</td>
                    <td style="padding-left:5px;padding-right:5px;"> : </td>
                    <td style="padding-left:5px;padding-right:5px;">{{\Carbon\Carbon::parse($agenda->start_date)->translatedFormat('H:i')}} - {{\Carbon\Carbon::parse($agenda->end_date)->translatedFormat('H:i')}} WIB</td>
                  </tr>
                  <tr>
                    <td style="padding-left:5px;padding-right:5px;"><i class="fa fa-calendar"></i></td>
                    <td style="padding-left:5px;padding-right:5px;">Tanggal</td>
                    <td style="padding-left:5px;padding-right:5px;"> : </td>
                    <td style="padding-left:5px;padding-right:5px;">
                      @php
                        $tgl_mulai = \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d F Y');
                        $tgl_selesai = \Carbon\Carbon::parse($agenda->end_date)->translatedFormat('d F Y');
                      @endphp
                      @if($tgl_mulai == $tgl_selesai)
                        {{\Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d F Y')}}
                      @else
                        {{\Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d F Y')}} - {{\Carbon\Carbon::parse($agenda->end_date)->translatedFormat('d F Y')}}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="padding-left:5px;padding-right:5px;vertical-align:top;"><i class="fa fa-file"></i></td>
                    <td style="padding-left:5px;padding-right:5px;vertical-align:top;">Deskripsi</td>
                    <td style="padding-left:5px;padding-right:5px;vertical-align:top;"> : </td>
                    <td style="padding-left:5px;padding-right:5px;">{!!$agenda->description !!}</td>
                  </tr>
                </table>
              </p>
            </div><!-- /.blog-desc -->
          </div><!-- /.entry-content -->
        </div><!-- /.blog-item -->
        <div class="blog-share">
          <h5 class="blog__share-title">Share This Content :</h5>
          <div class="sharethis-inline-share-buttons" style="z-index:10"></div>
        </div><!-- /.blog-share -->

      </div><!-- /.col-lg-9 -->

      <div class="col-sm-12 col-md-12 col-lg-4">
        <aside class="sidebar sidebar-wide">
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
            <h5 class="widget__title">Berita Terbaru</h5>
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
@endsection
@section('bottom-resource')
@endsection
