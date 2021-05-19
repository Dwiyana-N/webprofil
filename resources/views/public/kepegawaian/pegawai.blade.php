@extends('public.layout.app', ['title' => 'Data Pegawai'])

@section('meta')
  <meta name="description" content="Data Pegawai" />
  <meta name="keywords" content="Data Pegawai" />
  <meta property="og:title" content="Data Pegawai"/>
  <meta property="og:type" content="Data Pegawai"/>
  <meta property="og:image" content="{{asset('fontend/images/grid/1.jpg')}}"/>
@endsection

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Data Pegawai</h1>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

  <!-- ===== Bidang Section ===== -->
    <section id="team5" class="team team-2 team-5 text-center pt-100 pb-80">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading heading-3 text-center mb-60">
              <h2 class="heading__title">{{$bidang->name}}</h2>
              <p class="heading__desc">{!! $bidang->description !!}</p>
              <div class="divider__line"></div>
            </div><!-- /.heading -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
        @if(count($fetch) > 0)
          <!-- Member -->
          @foreach($fetch as $list)
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="card shadow">
              <div class="member">
                <div class="member__img">
                  <img src="{{asset('/storage/staff/images/'.$list->photo)}}" height="340px" width="200px" alt="{{$list->name}}">
                  <div class="member__hover">
                    <div class="member__content shadow-sm">
                      <div class="member__content-inner">
                        <div class="social__icons justify-content-center">
                          <a href="#"><i class="fa fa-phone" style="padding-right:4px"></i>{{$list->phone}}</a><br>
                          <a href="#"><i class="fa fa-envelope" style="padding-right:4px"></i>{{$list->email}}</a><br>
                          <a href="#"><i class="fa fa-home" style="padding-right:4px"></i>{{$list->address}}</a><br>
                        </div><!-- /.social-icons -->
                      </div><!-- /.member-content-inner -->
                    </div><!-- /.member-content -->
                  </div><!-- /.member-hover -->
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name">{{$list->name}}</h5>
                  <p class="member__desc">{{$list->position}}</p>
                </div><!-- /.member-info -->
              </div><!-- /.member -->
            </div>
          </div><!-- /.col-lg-3 -->
          @endforeach
       @else
          <div class="col text-center">
            <h5>- Tidak ada data -</h5>
          </div>
        @endif
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /. fancybox layout 1 -->
@endsection

@section('top-resource')
@endsection
@section('bottom-resource')
@endsection
