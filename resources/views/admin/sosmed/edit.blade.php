@extends('admin.layouts.app')

@section('title', 'Sunting Media Sosial')

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
            <li class="breadcrumb-item active"><small><strong>Edit</strong></small></li>
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
                  <h3 class="card-title"><strong>Sunting Media Sosial</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="{{route('admin.socmed.update')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <input type="hidden" name="id" value="{{$fetch->id}}">
                    <div class="form-group">
                      <label for="title">Media Sosial</label>
                      <select class="form-control select2bs4" name="name" style="width: 100%;">
                        <option value="facebook" @if($fetch->name == "facebook") selected @endif>Facebook</option>
                        <option value="twitter" @if($fetch->name == "twitter") selected @endif>Twitter</option>
                        <option value="youtube" @if($fetch->name == "youtube") selected @endif>Youtube</option>
                        <option value="instagram" @if($fetch->name == "instagram") selected @endif>Instagram</option>
                        <option value="linkedin" @if($fetch->name == "linkedin") selected @endif>LinkedIn</option>
                        <option value="tumblr" @if($fetch->name == "tumblr") selected @endif>Tumblr</option>
                        <option value="skype" @if($fetch->name == "skype") selected @endif>Skype</option>
                        <option value="googleplus" @if($fetch->name == "googleplus") selected @endif>Google+</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Icon <i class="fab fa-google-plus"></i> </label>
                      <select class="form-control icon" name="icon">

                        <option value="fab fa-facebook-f" @if($fetch->icon == "fab fa-facebook-f") selected @endif>&#xf09a; fa-facebook-f</option>
                    		<option value="fab fa-facebook-square" @if($fetch->icon == "fab fa-facebook-square") selected @endif>&#xf082; fa-facebook-square</option>
                    		<option value="fab fa-google-plus" @if($fetch->icon == "fab fa-google-plus") selected @endif>&#xf0d4; fa-google-plus</option>
                    		<option value="fab fa-instagram" @if($fetch->icon == "fab fa-instagram") selected @endif>&#xf16d; fa-instagram</option>
                    		<option value="fab fa-linkedin" @if($fetch->icon == "fab fa-linkedin") selected @endif>&#xf08c; fa-linkedin</option>
                    		<option value="fab fa-skype" @if($fetch->icon == "fab fa-skype") selected @endif>&#xf17e; fa-skype</option>
                    		<option value="fab fa-tumblr" @if($fetch->icon == "fab fa-tumblr") selected @endif>&#xf173; fa-tumblr</option>
                    		<option value="fab fa-tumblr-square" @if($fetch->icon == "fab fa-tumblr-square") selected @endif>&#xf174; fa-tumblr-square</option>
                    		<option value="fab fa-twitter" @if($fetch->icon == "fab fa-twitter") selected @endif>&#xf099; fa-twitter</option>
                    		<option value="fab fa-twitter-square" @if($fetch->icon == "fab fa-twitter-square") selected @endif>&#xf081; fa-twitter-square</option>
                    		<option value="fab fa-youtube" @if($fetch->icon == "fab fa-youtube") selected @endif>&#xf16a; fa-youtube</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="title">Link URL</label>
                      <input type="text" name="url" class="form-control" id="url" placeholder="Masukkan URL Media Sosial" value="{{$fetch->url}}" required>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show" @if($fetch->status == "show") selected @endif>Tampilkan</option>
                          <option value="hide" @if($fetch->status == "hide") selected @endif>Sembunyikan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-success float-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
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
