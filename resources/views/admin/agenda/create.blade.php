@extends('admin.layouts.app')

@section('title', 'Tambah Agenda')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Agendas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Agendas</strong></small></li>
            <li class="breadcrumb-item text-green"><small><strong>Add</strong></small></li>
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
                  <h3 class="card-title"><strong>Tambahkan Data Agenda</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.agenda.add')}}" id="quickForm" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Judul Agenda</label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan Judul Agenda">
                    </div>
                    <div class="form-group">
                      <label for="title">Lokasi</label>
                      <input type="text" name="location" class="form-control" id="location" placeholder="Masukkan Lokasi Kegiatan Agenda">
                    </div>
                    <div class="form-group">
                      <label for="title">Tanggal Mulai</label>
                      <div class="row">
                        <div class="col-8">
                          <input type="text" id="start_date" onblur="(this.type='text')" onfocus="(this.type='date')" name="start_date" aria-label="start_date" class="form-control" placeholder="Tanggal"/>
                        </div>
                        <div class="col-4">
                          <input type="text" id="start_time" onblur="(this.type='text')" onfocus="(this.type='time')" name="start_time" aria-label="start_time" class="form-control" placeholder="Jam (jam:menit AM/PM)"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="title">Tanggal Selesai</label>
                      <div class="row">
                        <div class="col-8">
                          <input type="text" id="end_date" onblur="(this.type='text')" onfocus="(this.type='date')" name="end_date" aria-label="end_date" class="form-control" placeholder="Tanggal"/>
                        </div>
                        <div class="col-4">
                          <input type="text" id="end_time" onblur="(this.type='text')" onfocus="(this.type='time')" name="end_time" aria-label="end_time" class="form-control" placeholder="Jam (jam:menit AM/PM)"/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="img">Gambar</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img" id="img">
                          <label class="custom-file-label" for="img">Unggah Gambar</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status">Terbitkan</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show">Ya</option>
                          <option value="hide">Tidak</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description">Deskripsi</label>
                      <textarea name="description" id="description" class="textarea" required></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-success float-right"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah</button>
                  </div>
                </form>
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
<!-- summernote -->
<link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('bottom-resource')
<!-- Summernote -->
<script src="{{asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
      height: 250
    });
  })
</script>
<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#quickForm').validate({
      rules: {
        title: {
          required: true,
        },
        description: {
          required: true,
        },
        location: {
          required: true,
        },
        start_date: {
          required: true,
        },
        end_date: {
          required: true,
        },
      },
      messages: {
        title: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan judul agenda",
        },
        description: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan deskripsi agenda",
        },
        location: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan lokasi agenda",
        },
        start_date: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan tanggal mulai agenda",
        },
        end_date: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan tanggal selesai agenda",
        },
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
      submitHandler: function (form) {
         $('#submit').attr('disabled','disabled');
         form.submit();
      }
    });
  });
</script>
<!-- Page script -->
<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
