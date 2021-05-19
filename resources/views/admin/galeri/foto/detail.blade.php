@extends('admin.layouts.app')
@section('title', 'Detail Foto')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$fetch->name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
              <li class="breadcrumb-item"><small><strong>Galleries</strong></small></li>
              <li class="breadcrumb-item"><small><strong>Photo</strong></small></li>
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
                  <h3 class="card-title"><strong>Detail Photo</strong></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->

                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Judul</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->name}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibuat Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($fetch->created_at)->translatedFormat('l, d F Y - h:i:s')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibuat Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->created_by}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Disunting Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($fetch->updated_at) ? \Carbon\Carbon::parse($fetch->updated_at)->translatedFormat('l, d F Y - h:i:s') : '-'}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Disunting Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($fetch->updated_by) ? $fetch->updated_by : ' - '}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Deskripsi</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {!! $fetch->description !!}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Status</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$fetch->status}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Gambar</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <img style="width:450px;height:auto" src="{{($fetch->img) ? asset('/storage/gallery/photo/images/'.$fetch->img) : asset('/frontend/images/features/1.jpg')}}">
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
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('bottom-resource')
<!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
