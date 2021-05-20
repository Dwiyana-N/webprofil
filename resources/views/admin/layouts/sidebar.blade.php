<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('backend/img/logo.png')}}"
         alt="Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: 1">
    <span class="brand-text font-weight-bold">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('backend/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @php $user = Auth::user() @endphp
        <span class="text-white"><label class="badge badge-success">{{ $user->getRoleNames()[0] }}</label></span>
      </div>
    </div>
    <div class="user-panel mt-2 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><span class="text-white"><strong>{{ Auth::user()->name }}</strong></span></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('admin.dashboard.index')}}" class="nav-link {{ Request::routeIs('admin.dashboard.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item active">
          <a href="{{route('admin.inbox.list')}}" class="nav-link {{ Request::routeIs('admin.inbox.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Pesan Masuk
              @php $count = App\Models\Inbox::where('status','unread')->count(); @endphp
              @if($count < 1)
                <span></span>
              @else
                <span class="badge badge-info right">{{ $count }}</span>
              @endif
            </p>
          </a>
        </li>

        @can('manipulate-master-datas')
        <li class="nav-header"><strong>DATA MASTER</strong></li>
        <li class="nav-item">
          <li class="nav-item has-treeview {{ Request::routeIs('admin.field.*')||Request::routeIs('admin.staff.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Unit Kerja
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item pl-2">
                <a href="{{route('admin.field.list')}}" class="nav-link {{ Request::routeIs('admin.field.*') ? 'active' : '' }}">
                  <i class="fas fa-briefcase nav-icon"></i>
                  <p>Bidang</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.staff.list')}}" class="nav-link {{ Request::routeIs('admin.staff.*') ? 'active' : '' }}">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>Staff/Pegawai</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        @endcan

        @can('manipulate-content')
        <li class="nav-header"><strong>MENU KONTEN</strong></li>
        <li class="nav-item">
          <a href="{{route('admin.profile.list')}}" class="nav-link {{ Request::routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="fas fa-home nav-icon"></i>
            <p class="text">Profil</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.agenda.list')}}" class="nav-link {{ Request::routeIs('admin.agenda.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>Agenda</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.announcement.list')}}" class="nav-link {{ Request::routeIs('admin.announcement.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Pengumuman</p>
          </a>
        </li>
        <li class="nav-item">
          <li class="nav-item has-treeview {{ Request::routeIs('admin.category.*')||Request::routeIs('admin.tag.*')||Request::routeIs('admin.article.*')||Request::routeIs('admin.comment.*')||Request::routeIs('admin.trash.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Berita/Artikel
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item pl-2">
                <a href="{{route('admin.category.list')}}" class="nav-link {{ Request::routeIs('admin.category.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-file"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.tag.list')}}" class="nav-link {{ Request::routeIs('admin.tag.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>Tag</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.article.list')}}" class="nav-link {{ Request::routeIs('admin.article.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Konten</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.comment.list')}}" class="nav-link {{ Request::routeIs('admin.comment.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-comments"></i>
                  <p>Komentar</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.trash.list')}}" class="nav-link {{ Request::routeIs('admin.trash.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-trash"></i>
                  <p>Tong Sampah</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        <li class="nav-item">
          <li class="nav-item has-treeview {{ Request::routeIs('admin.album.*')||Request::routeIs('admin.photo.*')||Request::routeIs('admin.video.*')||Request::routeIs('admin.infographic.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-camera"></i>
              <p>
                Galeri
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item pl-2">
                <a href="{{route('admin.album.list')}}" class="nav-link {{ Request::routeIs('admin.album.*')||Request::routeIs('admin.photo.*') ? 'active' : '' }}">
                  <i class="fas fa-image nav-icon"></i>
                  <p>Album Foto</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.video.list')}}" class="nav-link {{ Request::routeIs('admin.video.*') ? 'active' : '' }}">
                  <i class="fas fa-video nav-icon"></i>
                  <p>Video</p>
                </a>
              </li>
              <li class="nav-item pl-2">
                <a href="{{route('admin.infographic.list')}}" class="nav-link {{ Request::routeIs('admin.infographic.*') ? 'active' : '' }}">
                  <i class="fas fa-file-image nav-icon"></i>
                  <p>Info Grafis</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.slider.list')}}" class="nav-link {{ Request::routeIs('admin.slider.*') ? 'active' : '' }}">
            <i class="fas fa-images nav-icon"></i>
            <p class="text">Slider/Banner</p>
          </a>
        </li>
        @endcan

        <li class="nav-header"><strong>PENGATURAN</strong></li>
        @can('manipulate-master-settings')
        <li class="nav-item">
          <a href="{{route('admin.website.setting')}}" class="nav-link {{ Request::routeIs('admin.website.*') ? 'active' : '' }}">
            <i class="fas fa-house-user nav-icon"></i>
            <p class="text">Situs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.socmed.list')}}" class="nav-link {{ Request::routeIs('admin.socmed.*') ? 'active' : '' }}">
            <i class="fas fa-globe nav-icon"></i>
            <p class="text">Social Media</p>
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a href="{{route('admin.user.setting')}}" class="nav-link {{ Request::routeIs('admin.user.*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>Pengguna</p>
          </a>
        </li>

        <li class="nav-header"><strong></strong></li>
        <li class="nav-header"><strong></strong></li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Modal -->
<div class="modal fade" id="modal-out">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fas fa-sign-out"></i>Log Out</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          Anda akan meninggalkan sesi dan keluar dari sistem&hellip; <br>
          Klik "Iya" untuk melanjutkan
        </p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-success" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Iya</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /Modal -->
