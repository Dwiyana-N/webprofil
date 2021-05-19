@extends('admin.layouts.app')

@section('title', 'Detail Pegawai')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Staff</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Staff</strong></small></li>
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
                  <h3 class="card-title"><strong>Detail Data Pegawai</strong></h3>
                </div>
                <!-- /.card-header -->

                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Nama</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->name}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>NIP</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->nip}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tempat Lahir</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->birthplace}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tanggal lahir</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($fetch->birthday)->translatedFormat('l, d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Telepon</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->phone}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Email</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->email}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Golongan</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->golongan}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Jabatan</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->position}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Unit Kerja</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($fetch->field_id)?$fetch->field->name:'-'}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Foto</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        @if($fetch->photo)
                          <img style="width:350px;height:auto" src="{{asset('/storage/staff/images/'.$fetch->photo)}}">
                        @else
                          <img style="width:350px;height:auto" src="{{asset('backend/img/default.png')}}">
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
