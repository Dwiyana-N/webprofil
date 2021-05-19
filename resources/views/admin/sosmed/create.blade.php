@extends('admin.layouts.app')

@section('title', 'Tambah Media Sosial')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Social Media</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Admin</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Setting</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Social Media</strong></small></li>
            <li class="breadcrumb-item active"><small><strong>Add</strong></small></li>
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
                  <h3 class="card-title"><strong>Tambahkan Data Bidang Unit Kerja</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="{{route('admin.socmed.add')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Media Sosial</label>
                      <select class="form-control select2bs4" name="name" style="width: 100%;">
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="youtube">Youtube</option>
                        <option value="instagram">Instagram</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="tumblr">Tumblr</option>
                        <option value="skype">Skype</option>
                        <option value="googleplus">Google+</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Icon </label>
                      <select class="form-control icon" name="icon">

                        <option value="fab fa-facebook-f">&#xf09a; fa-facebook-f</option>
                    		<option value="fab fa-facebook-square">&#xf082; fa-facebook-square</option>
                    		<option value="fab fa-google-plus">&#xf0d4; fa-google-plus</option>
                    		<option value="fab fa-instagram">&#xf16d; fa-instagram</option>
                    		<option value="fab fa-linkedin">&#xf08c; fa-linkedin</option>
                    		<option value="fab fa-skype">&#xf17e; fa-skype</option>
                    		<option value="fab fa-tumblr">&#xf173; fa-tumblr</option>
                    		<option value="fab fa-tumblr-square">&#xf174; fa-tumblr-square</option>
                    		<option value="fab fa-twitter">&#xf099; fa-twitter</option>
                    		<option value="fab fa-twitter-square">&#xf081; fa-twitter-square</option>
                    		<option value="fab fa-youtube">&#xf16a; fa-youtube</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Link URL</label>
                      <input type="text" name="url" class="form-control" id="url" placeholder="Masukkan URL Media Sosial" required>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show">Tampilkan</option>
                          <option value="hide">Sembunyikan</option>
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style media="screen">
select.icon{
  font-family: fontAwesome
}
</style>
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
        description: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan nama bidang",
        },
        description: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan deskripsi bidang",
        }
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
@endsection
