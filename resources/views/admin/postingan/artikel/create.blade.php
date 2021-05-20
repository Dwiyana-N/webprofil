@extends('admin.layouts.app')

@section('title', 'Tambah Artikel')

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
                  <h3 class="card-title"><strong>Tambahkan Data Artikel</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.article.add')}}" id="quickForm" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Judul Artikel</label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan Judul Artikel">
                    </div>
                    <div class="form-group">
                      <label for="kategori_id">Kategori</label>
                      <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                        @foreach($category as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tag_id">Tag</label>
                      <div class="select2-green">
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Tag" data-dropdown-css-class="select2-green" style="width: 100%;">
                          @foreach($tag as $list)
                          <option value="{{$list->id}}">{{$list->name}}</option>
                          @endforeach
                        </select>
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
                      <label for="short_description">Selayang Pandang (Ringkasan)</label>
                      <input type="text" name="short_description" class="form-control" id="short_description" placeholder="Masukkan Selayang Pandang Artikel">
                    </div>
                    <div class="form-group">
                      <label for="content">Konten</label>
                      <textarea name="content" class="form-control my-editor"></textarea>
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
<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    ignore: ".textarea *",
    rules: {
      title: {
        required: true,
      },
      category_id: {
        required: true,
      },
      status: {
        required: true,
      },
      short_description: {
        required: true,
      },
      content: {
        required: true,
      }
    },
    messages: {
      title: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan judul artikel",
      },
      category_id: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih kategori artikel",
      },
      status: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih status penerbitan",
      },
      short_description: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan selayang pandang (ringkasan) artikel",
      },
      content: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan konten artikel",
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

<!-- TinyMCE init -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
  var editor_config = {
    path_absolute : "http://localhost/webprofil/public/", //diisi dengan url domain web
    selector: 'textarea.my-editor',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>

<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page script -->
<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>

@endsection
