@extends('admin.layouts.app')

@section('title', 'Detail Komentar')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Comments</strong></small></li>
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
                  <h3 class="card-title"><strong>Detail Komentar</strong></h3>
                </div>
                <!-- /.card-header -->
                <form id="quickForm" class="" action="{{route('admin.comment.reply')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Nama</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{$komentar->nama}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($komentar->created_at)->translatedFormat('l, d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibalas Oleh</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{($komentar->author)? $komentar->author : '-'}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Dibalas Tanggal</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {{\Carbon\Carbon::parse($komentar->updated_at)->translatedFormat('l, d F Y')}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Komentar</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        {!! $komentar->comment !!}
                      </div>
                    </div>
                    <hr>
                    <input type="hidden" name="id" id="id" value="{{$komentar->id}}">
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                        <label><strong>Status</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="form-group">
                        <div class="select2-green">
                          <select class="form-control select2bs4" name="status" style="width: 100%;">
                            <option>-- Pilih Status --</option>
                            <option value="show" @if($komentar->status == "show") selected @else "" @endif >Tampilkan</option>
                            <option value="hide" @if($komentar->status == "hide") selected @else "" @endif >Sembunyikan</option>
                          </select>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-3">
                          <label><strong>Balas Komentar</strong></label>
                      </div>
                      <div class="col-lg-9 col-md-9">
                        <div class="form-group">
                          <textarea name="reply" id="reply" class="form-control" required>
                          {{($komentar->reply) ? $komentar->reply : '-- balas komentar --'}}
                          </textarea>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-success float-right" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Kembali</button>
                    <button type="submit" class="btn btn-success float-right ml-1 mr-1"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
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
  $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1000000)
  }, 'File size must be less than {0} MB');

  $(document).ready(function () {
    $('#quickForm').validate({
      ignore: ".textarea",
      rules: {
        status: {
          required: true,
        },
        reply: {
          required: true,
        },
      },
      messages: {
        status: {
          required:"&nbsp;"+"Kolom tidak boleh kosong, silahkan pilih status",
        },
        reply: {
          required:"&nbsp;"+"Kolom tidak boleh kosong, silahkan balas komentar",
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
<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>

@endsection
