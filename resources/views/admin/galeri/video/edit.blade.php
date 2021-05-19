@extends('admin.layouts.app')
@section('title', 'Sunting Video')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Videos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Galleries</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Videos</strong></small></li>
            <li class="breadcrumb-item text-green"><small><strong>Edit</strong></small></li>
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
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.video.update')}}" id="quickForm" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <input type="hidden" name="id" id="id" value="{{$fetch->id}}">
                    <div class="form-group">
                      <label for="title">Judul</label>
                      <input type="text" name="title" class="form-control" id="title" value="{{$fetch->title}}">
                    </div>
                    <div class="form-group">
                      <label for="title">URL</label>
                      <input type="text" name="url" class="form-control" id="url" value="{{$fetch->url}}">
                    </div>
                    <div class="form-group">
                      <label for="img">Gambar Thumbnail</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail" value="{{$fetch->thumbnail}}">
                          <label class="custom-file-label" for="thumbnail">{{($fetch->thumbnail)?$fetch->thumbnail:'Unggah Gambar'}}</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status">Terbitkan</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show" @if($fetch->status == "show") selected @else "" @endif >Ya</option>
                          <option value="hide" @if($fetch->status == "hide") selected @else "" @endif >Tidak</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="description">Deskripsi</label>
                      <textarea name="description" id="description" class="form-control" required>{{$fetch->description}}</textarea>
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
  $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1000000)
  }, 'File size must be less than {0} MB');

  $(document).ready(function () {
    $('#quickForm').validate({
      ignore: ".textarea",
      rules: {
        title: {
          required: true,
        },
        description: {
          required: true,
        },
        url: {
          required: true,
        },
        thumbnail: {
          required: true,
          filesize : 1, // here we are working with MB
          extension: "jpg|jpeg|png|gif"
        }
      },
      messages: {
        title: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan judul video",
        },
        description: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan deskripsi video",
        },
        url: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan link/url video",
        },
        thumbnail: {
          required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan gambar cover untuk video",
          filesize: "&nbsp;"+"File gambar tidak boleh lebih dari 1 MB",
          extension: "&nbsp;"+"Format gambar tidak dikenali, pastikan format gambar *.jpg|*.jpeg|*.png|*.gif",
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
<!-- Page script -->
<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
