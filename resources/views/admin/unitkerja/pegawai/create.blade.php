@extends('admin.layouts.app')

@section('title', 'Tambah Data Pegawai')

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
                  <h3 class="card-title"><strong>Tambahkan Data Pegawai</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="{{route('admin.staff.add')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="status">Kategori</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="kategori" style="width: 100%;">
                          <option value="guru">Guru</option>
                          <option value="non-guru">Non Guru</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="title">Bidang Unit Kerja</label>
                      <select class="form-control select2bs4" name="field_id" style="width: 100%;">
                        <option value="0">Tidak Ada</option>
                        @foreach($field as $unker)
                          <option value="{{$unker->id}}">{{$unker->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Nama</label>
                      <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Nama Pegawai" required>
                    </div>
                    <div class="form-group">
                      <label for="title">NIP</label>
                      <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP Pegawai">
                    </div>
                    <div class="form-group">
                      <label for="title">Gologan</label>
                      <input type="text" name="golongan" class="form-control" id="golongan" placeholder="Masukkan Golongan Pegawai">
                    </div>
                    <div class="form-group">
                      <label for="title">Jabatan</label>
                      <input type="text" name="position" class="form-control" id="position" placeholder="Masukkan Jabatan Pegawai" required>
                    </div>
                    <div class="form-group">
                      <label for="title">Tempat Lahir</label>
                      <input type="text" name="birthplace" class="form-control" id="birthplace" placeholder="Masukkan Tempat Lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="title">Tanggal Lahir</label>
                      <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Masukkan Tanggal Lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="img">Gambar</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="photo" id="photo">
                          <label class="custom-file-label" for="photo">Unggah Gambar</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="title">Telepon</label>
                      <input type="text" name="phone" class="form-control" id="phone" placeholder="Masukkan Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                      <label for="title">Email</label>
                      <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                      <label for="content">Alamat</label>
                      <textarea name="address" id="address" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="status">Tampilkan</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show">Ya</option>
                          <option value="hide">Tidak</option>
                        </select>
                      </div>
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
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('bottom-resource')
<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#quickForm').validate({
      rules: {
        name: {
          required: true,
        },
        position: {
          required: true,
        },
        birthplace: {
          required: true,
        },
        birthday: {
          required: true,
        },
        phone: {
          required: true,
        },
        address: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan nama pegawai",
        },
        address: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan alamat pegawai",
        },
        position: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan jabatan pegawai",
        },
        birthplace: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan tempat lahir pegawai",
        },
        birthday: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan tanggal lahir pegawai",
        },
        phone: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan nomor telepon pegawai",
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
