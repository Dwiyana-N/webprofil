@extends('admin.layouts.app')

@section('title', 'Detail Artikel')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Articles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Articles</strong></small></li>
            <li class="breadcrumb-item text-green"><small><strong>Detail</strong></small></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><strong>Detail Artikel</strong></h3>
                </div>
                <!-- /.card-header -->

                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Judul</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$post->title}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibuat Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$post->created_by}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Disunting Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($post->updated_by) ? '$post->updated_by' : ' - '}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Kategori</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{ $post->category->name }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tag</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        @foreach($post->tags as $tag) <span class="badge badge-success">{{$tag->name}}</span> @endforeach
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Selayang Pandang</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{ $post->short_description }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Konten</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {!! $post->content !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Gambar</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <img style="width:450px;height:auto" src="{{asset('/storage/article/images/'.$post->img)}}">
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-success float-right" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Kembali</button>
                  </div>

              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
@endsection

@section('top-resource')

@endsection

@section('bottom-resource')

@endsection
