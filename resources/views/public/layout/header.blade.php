<header id="header3" class="header header-3 header-full">
  <div class="header__topbar header__topbar-dark color-white">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-9 col-lg-9">
          <ul class="contact__list list-unstyled">
            <li><i>{{\Carbon\Carbon::now()->translatedFormat('l, d F Y')}}</i></li>
          </ul>
        </div><!-- /.col-lg-9 -->
        <div class="col-sm-4 col-md-3 col-lg-3">
          <div class="social__icons justify-content-end">
            <span>Follow Us:</span>

            @foreach($getsosmed as $sosmed)
              <a href="{{$sosmed->url}}" title="{{$sosmed->name}}"><i class="fa {{$sosmed->icon}}"></i></a>
            @endforeach

            <a href="#"><i class="fa fa-feed"></i></a>
          </div><!-- /.social-icons -->
        </div><!-- /.col-lg-3 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.header-top -->

  <!-- === Menu Nav === -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        @if($logo)
        <img src="{{asset('storage/website/'.$logo)}}" width="auto" height="87px" class="logo-dark">
        @else
        <img class="logo" src="{{asset('backend/img/tutwurihandayani.png')}}" height="80px">
        @endif
      </a>
      <button class="navbar-toggler" type="button">
        <span class="menu-lines"><span></span></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavigation">
        <ul class="navbar-nav mr-30 ml-30 mr-auto">
          <li class="nav__item">
            <a href="{{route('public.homepage')}}" class="nav__item-link {{ Request::routeIs('public.homepage') ? 'active' : '' }}">Beranda</a>
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.profil') ? 'active' : '' }}">Profil</a>
            @if(count($profils) > 0)
      			<ul class="dropdown-menu">
      				  @foreach($profils as $profil)
                <li class="nav__item">
      						<a href="{{route('public.profile', ['slug'=>$profil->slug])}}" class="nav__item-link">{{$profil->title}}</a>
      					</li>
                @endforeach
            </ul><!-- /.dropdown-menu -->
			      @endif
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.profil') ? 'active' : '' }}">Desa</a>
            @if(count($profils) > 0)
      			<ul class="dropdown-menu">
      				  @foreach($profils as $profil)
                <li class="nav__item">
      						<a href="{{route('public.profile', ['slug'=>$profil->slug])}}" class="nav__item-link">{{$profil->title}}</a>
      					</li>
                @endforeach
            </ul><!-- /.dropdown-menu -->
			      @endif
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.wisata') ? 'active' : '' }}">Wisata</a>
            @if(count($wisata_menu) > 0)
      			<ul class="dropdown-menu">
      				  @foreach($wisata_menu as $row)
                <li class="nav__item">
      						<a href="{{route('public.wisata', ['slug'=>$row->slug])}}" class="nav__item-link">{{$row->title}}</a>
      					</li>
                @endforeach
            </ul><!-- /.dropdown-menu -->
            @endif
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.profil') ? 'active' : '' }}">Pelayanan Publik</a>
            @if(count($profils) > 0)
      			<ul class="dropdown-menu">
      				  @foreach($profils as $profil)
                <li class="nav__item">
      						<a href="{{route('public.profile', ['slug'=>$profil->slug])}}" class="nav__item-link">{{$profil->title}}</a>
      					</li>
                @endforeach
            </ul><!-- /.dropdown-menu -->
			      @endif
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.agenda.*')||Request::routeIs('public.announcement.*')||Request::routeIs('public.article.*')||Request::routeIs('public.album.*')||Request::routeIs('public.video.*')||Request::routeIs('public.infographic.*') ? 'active' : '' }}">Informasi Publik</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="{{route('public.agenda.list')}}" class="nav__item-link {{ Request::routeIs('public.agenda.*') ? 'active' : '' }}">Agenda</a></li>
              <li class="nav__item"><a href="{{route('public.announcement.list')}}" class="nav__item-link {{ Request::routeIs('public.announcement.*') ? 'active' : '' }}">Pengumuman</a></li>
              <li class="nav__item"><a href="{{route('public.article.list')}}" class="nav__item-link {{ Request::routeIs('public.article.*') ? 'active' : '' }}">Artikel</a></li>
			            <li class="nav__item dropdown-submenu">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.album.*')||Request::routeIs('public.video.*')||Request::routeIs('public.infographic.*') ? 'active' : '' }}">Galeri</a>
                    <ul class="dropdown-menu">
                      <li class="nav__item"><a href="{{route('public.album.list')}}" class="nav__item-link {{ Request::routeIs('public.album.*') ? 'active' : '' }}">Album Foto</a></li>
                      <li class="nav__item"><a href="{{route('public.video.list')}}" class="nav__item-link {{ Request::routeIs('public.video.*') ? 'active' : '' }}">Video</a></li>
                      <li class="nav__item"><a href="{{route('public.infographic.list')}}" class="nav__item-link {{ Request::routeIs('public.infographic.*') ? 'active' : '' }}">Info Grafis</a></li>
                    </ul><!-- /.dropdown-menu -->
                  </li><!-- /.nav-item -->
            </ul><!-- /.dropdown-menu -->
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link {{ Request::routeIs('public.field')||Request::routeIs('public.staff') ? 'active' : '' }}">Kepegawaian</a>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="{{route('public.field')}}" class="nav__item-link {{ Request::routeIs('public.field')||Request::routeIs('public.staff') ? 'active' : '' }}">Data Pegawai</a></li>
              <!-- /.nav-item -->
            </ul><!-- /.dropdown-menu -->
          </li><!-- /.nav-item -->
          <li class="nav__item">
            <a href="{{route('public.contact')}}" class="nav__item-link {{ Request::routeIs('public.contact') ? 'active' : '' }}">Pengaduan</a>
          </li><!-- /.nav-item -->
        </ul><!-- /.navbar-nav -->
      </div><!-- /.navbar-collapse -->
      <div class="navbar-modules">
        <div class="modules__wrapper d-flex align-items-center">
          <a href="#" class="module__btn module__btn-search"><i class="york-search"></i></a>
        </div><!-- /.modules-wrapper -->
      </div><!-- /.navbar-modules -->
    </div><!-- /.container -->
  </nav><!-- /.navabr -->
</header><!-- /.Header 3 -->
