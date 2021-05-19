@extends('public.layout.app', ['title' => 'Hasil Pencarian'])

@section('content')
  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/04.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Pencarian</h1>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

<!-- === Blog Single === -->
<section id="blogSingleRightSidebar" class="blog blog-single pb-60">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">

                <h6>Hasil pencarian dengan kata kunci : <b>{{$keyword}}</b></h6><br>
                @if(count($results) > 0)
                @foreach($results as $result)
                @foreach($result as $data)

                @if($data->tabel == 'agendas')
                @php
                $url = route('public.agenda.detail',['slug'=>$data->slug]);
                @endphp
                @elseif($data->tabel == 'articles')
                @php
                $url = route('public.article.detail',['slug'=>$data->slug]);
                @endphp
                @elseif($data->tabel == 'albums')
                @php
                $url = route('public.album.detail',['slug'=>$data->slug]);
                @endphp
                @elseif($data->tabel == 'announcements')
                @php
                $url = route('public.announcement.detail',['slug'=>$data->slug]);
                @endphp
                @elseif($data->tabel == 'video')
                @php
                $url = route('public.video.detail',['slug'=>$data->slug]);
                @endphp
                @elseif($data->tabel == 'info_graphics')
                @php
                $url = route('public.infographic.detail',['slug'=>$data->slug]);
                @endphp
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{$url}}" style="color:black;text-decoration:none"
                            class="d-block">
                            <h6>{{$data->title}}</h6>
                        </a>
                        {{ \Illuminate\Support\Str::limit(strip_tags($data->desc),150,'...') }}                     
                    </div>
                </div>
                <br>
                @endforeach
                @endforeach
                @else
                <center><b>Mohon maaf data tidak ditemukan</b></center>
                @endif

      </div><!-- /.col-lg-9 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.blog Single -->
@endsection

@section('top-resource')
@endsection
@section('bottom-resource')
@endsection
