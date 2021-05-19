@extends('admin.layouts.app')
@section('title', 'Pengaturan Pengguna')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Admin</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Setting</strong></small></li>
            <li class="breadcrumb-item text-green"><small><strong>User</strong></small></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @can('manipulate-master-users')
          <!-- Default box -->
          <div class="card card-success collapsed-card">
            <div class="card-header">
              <h3 class="card-title"><strong>List Admin</strong></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-plus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <h3 class="card-title">Data Admin Web</h3>
              <a href="{{route('admin.user.create')}}" class="btn btn-success float-right py-2 mb-2">
                <i class="fas fa-plus-square"></i> Tambah Data
              </a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @php $i=1 @endphp
                  @foreach($list as $row)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->getRoleNames()[0] }}{{-- $row->roles->pluck('name')[0] --}}</td>
                    <td>
                      <a href="{{route('admin.user.edit',['id' => $row->id])}}" class="btn btn-md btn-success btn-icon" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" data-toggle="modal" data-target="#hapus{{$row->id}}" class="btn btn-md btn-danger btn-icon" title="Hapus">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <!-- modal -->
                  <div class="modal fade" id="hapus{{$row->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><i class="fas fa-trash"></i>Hapus Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>
                            Apakah anda yakin untuk menghapus data " {{$row->name}} " ?
                          </p>
                        </div>
                        <div class="modal-footer">
                          <form id="hapus-data" action="{{ route('admin.user.delete') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-danger">Iya</button>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  @php $i++ @endphp
                  @endforeach
                  </tbody>
              </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
          @endcan
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><strong>Update Data User</strong></h3>
                </div>
                <!-- /.card-header -->
                <form id="quickForm" action="{{route('admin.user.updatesetting')}}" method="post">
                  @csrf
                  <div class="card-body">
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Nama</strong></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$fetch->name}}" required>
                        </div>
                    </div>
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Username</strong></label>
                            <input type="text" name="username" class="form-control" value="{{$fetch->username}}" required>
                        </div>
                    </div>
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Email</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{$fetch->email}}" required>
                        </div>
                    </div>
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Password Lama</strong></label>
                            <input type="password" name="current_password" id="current_password" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Password Baru</strong></label>
                            <input type="password" name="password" id="password" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-row my-10 pb-2">
                        <div class="col-md-12 mb-10">
                            <label for="validationCustom01"><strong>Konfirmasi Password Baru</strong></label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control" value="">
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i>&nbsp;&nbsp;Simpan</button>
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
        rules: {
          username: {
            required: true,
          },
          name: {
            required: true,
          },
          email: {
            required: true,
          },
          current_password: {
            required: true,
          },
          password: {
            required: true,
          },
          password_confirm: {
            required: true,
            equalTo: "#password"
          }
        },
        messages: {
          username: {
            required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan username",
          },
          name: {
            required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan nama pengguna",
          },
          email: {
            required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan email pengguna",
          },
          current_password: {
            required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan kata sandi lama",
          },
          password: {
            required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan kata sandi baru",
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
@endsection
