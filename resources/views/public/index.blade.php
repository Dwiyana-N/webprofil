@extends('public.layout.app', ['title' => (!empty($getsitus))?$getsitus->name:'Subang'])

@section('meta')

@endsection

@section('content')

      <!-- === Slider === -->
      <section id="slider3" class="slider slider-3 text-center">
        <div class="carousel owl-carousel carousel-arrows carousel-dots" data-slide="1" data-slide-md="1" data-slide-sm="1"
          data-autoplay="false" data-nav="true" data-dots="true" data-space="0" data-loop="true" data-speed="3000">
          @if(count($slider) > 0)
          @foreach($slider as $banner)
          <div class="slide-item align-v-h bg-overlay bg-overlay-2">
            <div class="bg-img"><img src="{{asset('/storage/slider/images/'.$banner->img)}}" alt="slide img"></div>
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
                  <div class="slide__content">
                    <h2 class="slide__title color-white">{{$banner->name}}</h2>
                    <div class="heading__shape2 heading__shape2-white"></div>
                    <p class="slide__desc color-white">{{strip_tags($banner->description)}}</p>
                  </div><!-- /.slide-content -->
                </div><!-- /.col-lg-10 -->
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.slide-item -->
          @endforeach
          @endif
        </div><!-- /.carousel -->
      </section><!-- /.slider -->

      <!-- === Features === -->
      <section id="accordions1" class="accordions bg-gray">
        <div class="container">
          <div class="row">
          @if(count($agendas) > 0)
            <!-- item -->
            @php $i=1 @endphp
            @foreach($agendas as $agenda)
            <div class="col-sm-12 col-lg-4">
              <div id="accordion{{$i}}">
                <div class="accordion-item">
                  <div class="accordion__item-header" data-toggle="collapse" data-target="#collapse{{$i}}">
                    <a class="accordion__item-title" href="#">{{$agenda->title}}</a>
                  </div><!-- /.accordion-item-header -->
                  <div id="collapse{{$i}}" class="collapse" data-parent="#accordion{{$i}}">
                    <div class="accordion__item-body">
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
                          <td style="padding-left:5px;padding-right:5px;">{{\Carbon\Carbon::parse($agenda->start_date)->translatedFormat('h:i')}} - {{\Carbon\Carbon::parse($agenda->end_date)->translatedFormat('h:i')}} WIB</td>
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
                      <hr>
                      <span class="badge badge-secondary" style="padding:10px;vertical-align:top;">  
                        <a href="{{route('public.agenda.detail', ['slug'=>$agenda->slug])}}" style="padding:2px;color:#fff;">more...</a>
                      </span>
                    </div><!-- /.accordion-item-body -->
                  </div>
                </div><!-- /.accordion-item -->
              </div>
            </div><!-- /.col-lg-12 -->
            @php $i++ @endphp
            @endforeach
          @else
          <div class="col-sm-12 col-md-12 col-lg-12 text-center">
              <span style="font-weight:bold;"><h4>- Tidak ada agenda -</h4></span>
          </div>
          @endif
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section><!-- /.Accordions 1 -->

      <!-- === Sambutan === -->
      {{-- <section id="banner2" class="skills skills-3 banner-2 p-0 bg-gray">
        <div class="container-fluid col-padding-0">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="banner__img bg-overlay">
                <div class="bg-img"><img src="{{asset('frontend/images/banners/4.jpg')}}" alt="background"></div>
              </div><!-- /.banner-img -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="inner-padding">
                <div class="heading heading-4 heading-7 mb-40">
                  <h2 class="heading__title">Stunning & Great <br>Business Solutions!!</h2>
                  <div class="divider__line divider__theme divider__left"></div>
                  <p class="heading__desc">On top it, pleasing images create a better user experience. Rounding up a
                    bunch of specific designs and talking about the merits of way!</p>
                </div><!-- /.heading -->
                <!-- progress 1 -->
                <div class="progress-item">
                  <h6 class="progress__title">Marketing</h6>
                  <div class="progress">
                    <div class="progress-bar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                      <span class="progress__percentage"></span>
                    </div>
                  </div><!-- /.progress -->
                </div><!-- /.progress-item  -->
                <!-- progress 2 -->
                <div class="progress-item">
                  <h6 class="progress__title">Development</h6>
                  <div class="progress">
                    <div class="progress-bar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                      <span class="progress__percentage"></span>
                    </div>
                  </div><!-- /.progress -->
                </div><!-- /.progress-item  -->
                <!-- progress 3 -->
                <div class="progress-item">
                  <h6 class="progress__title">User Experience</h6>
                  <div class="progress">
                    <div class="progress-bar" aria-valuenow="81" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                      <span class="progress__percentage"></span>
                    </div>
                  </div><!-- /.progress -->
                </div><!-- /.progress-item  -->
                <!-- progress 4 -->
                <div class="progress-item">
                  <h6 class="progress__title">Branding</h6>
                  <div class="progress">
                    <div class="progress-bar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" role="progressbar">
                      <span class="progress__percentage"></span>
                    </div>
                  </div><!-- /.progress -->
                </div><!-- /.progress-item  -->
              </div>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section> --}}

      <!-- === Blog === -->
      <section id="blog" class="blog blog-grid pt-100 pb-80">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
              <div class="heading heading-3 text-center mb-60">
                <h2 class="heading__title">Artikel Terbaru</h2>
                <div class="divider__line"></div>
              </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
          <div class="row">
            <!-- Blog Item -->
            @if(count($blog) > 0)
            @foreach($blog as $article)
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="blog-item">
                <div class="blog__img">
                  <a href="{{route('public.article.detail',['slug'=>$article->slug])}}">
                    <img height="180px" width="180px"  src="{{($article->img) ? asset('/storage/article/images/'.$article->img) : asset('backend/img/default.png')}}" alt="{{$article->title}}">
                  </a>
                </div><!-- /.entry-img -->
                <div class="blog__content">
                  <div class="blog__meta">
                    <div class="blog__meta-cat">
                      <a href="#">{{$article->category->name}}</a>
                    </div><!-- /.blog-meta-cat -->
                    <span class="blog__meta-date"><i class="fas fa-eye"></i>{{\Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y')}}</span>
                  </div><!-- /.blog-meta -->
                  <h4 class="blog__title"><a href="{{route('public.article.detail',['slug'=>$article->slug])}}">{{$article->title}}</a></h4>
                  <p class="blog__desc">{{strip_tags($article->short_description)}}</p>
                  <a href="{{route('public.article.detail',['slug'=>$article->slug])}}" class="btn btn__secondary btn__link">Read More</a>
                </div><!-- /.entry-content -->
              </div><!-- /.blog-item -->
            </div><!-- /.col-lg-4 -->
            @endforeach
            @else
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <span style="font-weight:bold;"><h4>- Belum ada data -</h4></span>
            </div>
            @endif
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section><!-- /.blog -->

      <!-- === Pengumuman ===  -->
      <section id="testimonial4"
        class="testimonial testimonial-1 testimonial-4 testimonial-white-text bg-overlay bg-overlay-3 bg-parallax text-center pt-100 pb-100">
        <div class="bg-img"><img src="assets/images/backgrounds/3.jpg" alt="background"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
              <div class="heading heading-4 text-center mb-60">
                <h2 class="heading__title">Pengumuman</h2>
                <div class="divider__line divider__theme"></div>
              </div><!-- /.heading 6 -->
            </div><!-- /.col-lg-8 -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
              <div class="carousel owl-carousel carousel-arrows" data-slide="1" data-slide-md="1" data-slide-sm="1"
                data-autoplay="true" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="800">
                <!-- pengumuman -->
                @if(count($announcement) > 0)
                @foreach($announcement as $pengumuman)
                <div class=" testimonial-item">
                  <div class="testimonial__content">
                    <p class="testimonial__desc"><a href="{{route('public.announcement.detail',['slug'=>$pengumuman->slug])}}">{{strip_tags($pengumuman->title)}}</a></p>
                  </div><!-- /.testimonial-content -->
                  {{-- <div class="testimonial__icon"></div> --}}
                  <div class="testimonial__meta">
                    <h5 class="testimonial__meta-title">{{\Carbon\Carbon::parse($pengumuman->created_at)->translatedFormat('d F Y')}}</h5>
                    <p class="testimonial__meta-desc">
                      @if(!empty($pengumuman->updated_by))
                        {{$pengumuman->updated_by}}
                      @else
                        {{$pengumuman->created_by}}
                      @endif
                    </p>
                  </div><!-- /.testimonial-meta -->
                </div><!-- /. testimonial-item -->
                @endforeach
                @else
                <div>
                    <span style="font-weight:bold;"><h4 style="color:#fff;">- Belum ada data -</h4></span>
                </div>
                @endif
              </div>
            </div><!-- /.col-lg-10 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>

      <!-- === Staff === -->
      <section id="team3" class="team team-2 team-3 text-center pt-100 pb-0">
        <div class="container-fluid col-padding-0">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
              <div class="heading heading-3 mb-60">
                <h2 class="heading__title">Pegawai / Staff</h2>
                <div class="divider__line"></div>
              </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
          @if(count($staff) > 0)
          <div class="row">
            <!-- Member -->
            @foreach($staff as $pegawai)
            <div class="col-sm-6 col-md-3 col-lg-3">
              <div class="card mx-4 my-2 shadow">
                <div class="member">
                  <div class="member__img">
                    <img src="{{asset('/storage/staff/images/'.$pegawai->photo)}}" height="340px" width="180px" alt="{{$pegawai->name}}">
                  </div><!-- /.member-img -->
                  <div class="member__hover ">
                    <div class="member__content shadow-sm">
                      <div class="member__content-inner">
                        <div class="member__info">
                          <h5 class="member__name">{{$pegawai->name}}</h5>
                          <p class="member__desc">{{$pegawai->position}}</p><hr>
                          <p class="member__desc"><strong>{{($pegawai->field_id)?$pegawai->field->name:''}}</strong></p>
                        </div><!-- /.member-info -->
                      </div><!-- /.member-content-inner -->
                    </div><!-- /.member-content -->
                  </div><!-- /.member-hover -->
                </div><!-- /.member -->
              </div>
            </div><!-- /.col-lg-3 -->
            @endforeach
          </div><!-- /.row -->
          <div class="pt-4">
              <span style="font-weight:bold;"><a class="btn btn-secondary shadow" href="{{route('public.field')}}">- More -</a></span>
          </div>
          @else
          <div class="row">
            <div class="col">
                <span style="font-weight:bold;text-align:center"><h4>- Belum ada data -</h4></span>
            </div>
          </div>
          @endif
        </div><!-- /.container -->
      </section>

      <section id="cta1" class="cta cta-1 pt-60 pb-60 text-center-xs-sm">
        <div class="container">
          <div class="row">

          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>

@endsection

@section('top-resource')
@endsection
@section('bottom-resource')
@endsection
