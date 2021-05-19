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
    <section id="fancyboxLayout1" class="fancybox-layout1 text-center pt-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading heading-3 mb-60">
              <h2 class="heading__title">Unit Kerja {{(!empty($getsitus))?$getsitus->name:''}}</h2>
              <p class="heading__desc">Pilih salah satu data untuk melihat detail data</p>
              <div class="divider__line"></div>
            </div>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row mb-80 mb-30-xs mb-30-sm">
		    @if(count($fetch) > 0)
          <!-- fancybox item -->
		      @foreach($fetch as $list)
          <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
            <div class="fancybox-item">
              <div class="fancybox__icon">
      				@if($list->img)
      					<img src="{{asset('storage/field/images/'.$list->img)}}" width="62px" height="62px" class="img-fluid">
      				@else
      					<i class="icon-layers"></i>
      				@endif
              </div><!-- /.fancybox-icon -->
              <div class="fancybox__content">
                <h4 class="fancybox__title"><a href="{{route('public.staff', ['slug'=>$list->slug])}}">{{$list->name}}</a></h4>
                <p class="fancybox__desc">{!! $list->description !!}</p>
                <div class="dotted__line"><span></span></div>
              </div><!-- /.fancybox-content -->
            </div><!-- /.fancybox-item -->
          </div><!-- /.col-lg-4 -->
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
