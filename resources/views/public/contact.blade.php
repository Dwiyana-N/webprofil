@extends('public.layout.app', ['title' => 'Hubungi Kami'])
@section('meta')

@endsection
@section('content')

  <!-- === Page Title === -->
  <section id="page-title" class="page-title page-title-layout1 bg-overlay bg-overlay-3 text-center">
    <div class="bg-img"><img src="{{asset('frontend/images/page-titles/11.jpg')}}" alt="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <h1 class="pagetitle__heading">Hubungi Kami</h1>
        </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- /.page-title -->

      <!-- ==Contact== -->
      <section id="contact1" class="contact p-0" style="padding-top:10px;margin-top:10px">
        <div class="container-fluid col-padding-0">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="contact__banner align-v-h bg-overlay">
                <div class="bg-img"><img src="{{asset('frontend/images/page-titles/16.jpg')}}" alt="background"></div>
                <div class="heading text-center">
                  <div class="heading__shape heading__shape-white"></div>
                  <h2 class="heading__title color-white">Silahkan Kirim Kritik/Saran/Keluhan Anda.</h2>
                  <div class="divider__line divider__white"></div>
                </div><!-- /.heading -->
              </div><!-- /.contact-banner -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6 bg-gray">
              <div class="inner-padding">
                <div class="heading">
                  <h2 class="heading__title lh-1 mb-50">Write To Us</h2>
                </div><!-- /.heading -->
                <form method="post" action="{{route('public.sendmessage')}}">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Nama"></div>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email"></div>
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <div class="form-group"><input type="text" name="address" class="form-control" placeholder="Alamat/Lokasi"></div>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-sm-6 col-md-6 col-lg-6">
                      <div class="form-group"><input type="text" name="subject" class="form-control" placeholder="Subjek/Judul"></div>
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group mb-30"><textarea name="message" class="form-control" placeholder="Pesan"></textarea></div>
                    </div><!-- /.col-lg-12 -->
                  </div><!-- /.row -->
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <button type="submit" class="btn btn__rounded btn__primary btn__hover3">Kirim</button>
                    </div><!-- /.col-lg-12 -->
                  </div><!-- /.row -->
                </form>
              </div>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section><!-- /.contact 1 -->

@endsection
@section('top-resource')
@endsection
@section('bottom-resource')
@endsection
