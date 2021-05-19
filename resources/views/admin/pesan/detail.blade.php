@extends('admin.layouts.app')
@section('title', $inbox->subject)
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inbox</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Admin</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Inbox</strong></small></li>
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
                  <h3 class="card-title"><strong>Detail Pesan</strong></h3>
                </div>
                <!-- /.card-header -->

                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Pengirim</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$inbox->name}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($inbox->created_at)->translatedFormat('d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Email</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$inbox->email}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Alamat / Lokasi</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$inbox->address}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Subjek</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$inbox->subject}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Status</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$inbox->status}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Pesan</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {!! $inbox->message !!}
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
