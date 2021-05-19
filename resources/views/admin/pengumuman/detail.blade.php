@extends('admin.layouts.app')

@section('title', 'Detail Pengumuman')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Announcement</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Announcement</strong></small></li>
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
                  <h3 class="card-title"><strong>Detail Pengumuman</strong></h3>
                </div>
                <!-- /.card-header -->

                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Judul</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$announce->title}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($announce->created_at)->translatedFormat('d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibuat Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$announce->created_by}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Disunting Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($announce->updated_by) ? $announce->updated_by : ' - '}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Deskripsi</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {!! $announce->description !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Gambar</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <img style="width:450px;height:auto" src="{{asset('/storage/announcement/images/'.$announce->img)}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Lampiran File</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        @if($announce->file)                          
                          <object data="{{asset('/storage/announcement/files/'.$announce->file)}}" type="application/pdf" width="100%" height="600px" style="padding: 10px 0">
                              <iframe src="{{asset('storage/announcement/files/'.$announce->file)}}" width="100%"></iframe>
                          </object>  
                          <br><a class="btn btn-sm btn-secondary" href="{{url('/storage/announcement/files/'.$announce->file)}}" target="_blank">Lihat file</a><br>                        
                        @else
                          <label for="example-text-input" class="col-form-label">-</label>
                        @endif
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
