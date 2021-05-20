@extends('admin.layouts.app')

@section('title', 'Sunting Artikel')

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
                <div class="card-header">
                  <h3 class="card-title"><strong>Sunting Data Artikel</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.article.update')}}" id="quickForm" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <input type="hidden" name="id" class="form-control" id="id" value="{{$article->id}}">
                    <div class="form-group">
                      <label for="title">Judul Artikel</label>
                      <input type="text" name="title" class="form-control" id="title" value="{{$article->title}}">
                    </div>
                    <div class="form-group">
                      <label for="kategori_id">Kategori</label>
                      <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                        {{--@foreach($category as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach--}}

                        @foreach ($category as $c)
                          <option value="{{$c->id}}"
                              @if($c->id == $article->category_id)
                                selected
                              @endif
                          >{{$c->name}}</option>
                        @endforeach

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tag_id">Tag</label>
                      <div class="select2-green">
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Tag" data-dropdown-css-class="select2-green" style="width: 100%;">
                        {{--  @foreach($tag as $list)
                          <option value="{{$list->id}}">{{$list->name}}</option>
                          @endforeach --}}

                          @foreach($tag as $data)
                            <option value="{{$data->id}}"
                              @foreach($article->tags as $key)
                                @if($data->id == $key->id)
                                  selected
                                @endif
                              @endforeach>
                              {{$data->name}}
                            </option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="img">Gambar</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img" id="img" value="{{$article->img}}">
                          <label class="custom-file-label" for="img">{{($article->img)?$article->img:'Unggah File'}}</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status">Terbitkan</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show" @if($article->status == "show") selected @else "" @endif >Ya</option>
                          <option value="hide" @if($article->status == "hide") selected @else "" @endif >Tidak</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="short_description">Selayang Pandang (Ringkasan)</label>
                      <input type="text" name="short_description" class="form-control" id="short_description" value="{{$article->short_description}}">
                    </div>
                    <div class="form-group">
                      <label for="content">Konten</label>
                      {{-- <textarea name="content" id="summernote-editor"></textarea> --}}
                      <textarea name="content" class="form-control my-editor">{{$article->content}}</textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

      </section>
      <!-- /.content -->
</div>
@endsection

@section('top-resource')
<!-- summernote -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<style>
  .popover {
    top: auto;
    left: auto;
  }
</style>
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('bottom-resource')
<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
{{--<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    ignore: ".textarea *",
    rules: {
      title: {
        required: true,
      },
      kategori_id: {
        required: true,
      },
      tag_id: {
        required: true,
      },
      img: {
        required: true,
      },
      status: {
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
      kategori_id: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih kategori artikel",
      },
      tag_id: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih tag artikel",
      },
      img: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan gambar artikel",
      },
      status: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih status penerbitan",
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
    }
  });
});
</script>--}}

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

<script>
 var route_prefix = "/webprofil/public/filemanager";
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script>
  $(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/webprofil/public/filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/webprofil/public/filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });

        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#summernote-editor').summernote({
      height: 400,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['popovers', ['lfm']],
      ],
      buttons: {
        lfm: LFMButton
      }
    })
  });
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
