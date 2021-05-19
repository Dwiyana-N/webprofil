<footer id="footer1" class="footer footer-1 color-white bg-heading">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3 footer__widget footer__widget-about">
          <div class="footer__widget-content">
            @if($logo)
            <img src="{{asset('/storage/website/'.$logo)}}" height="160px" class="footer__logo">
            @else
            <h2 style="color:#fff">{{(!empty($getsitus))?$getsitus->name:''}}</h2>
            @endif
            {{-- <p>{{($getsitus->description)?$getsitus->description:''}}</p> --}}
            @if(!empty($getsitus))
            <ul class="contact__list list-unstyled">
              <li><i class="fa fa-phone-square"></i><span style="padding-left:7px;">{{(!empty($getsitus))?$getsitus->phone:'-'}}</span></li>
              <li><i class="fa fa-envelope"></i><span style="padding-left:7px;">{{(!empty($getsitus))?$getsitus->email:'-'}}</span></li>
              <li><i class="fa fa-map"></i><span style="padding-left:7px;">{{(!empty($getsitus))?strip_tags($getsitus->address):'-'}}</span></li>
            </ul>
            @endif
          </div>
        </div><!-- /.col-lg-3 -->
        <div class="col-sm-12 col-md-6 col-lg-3 footer__widget footer__widget-posts"></div>
        <div class="col-sm-12 col-md-6 col-lg-3 footer__widget footer__widget-posts">
          <h6 class="footer__widget-title">Statistik Pengunjung</h6>
          <div class="footer__widget-content">
            <table class="text-white">
  						<tr>
  							<td valign="top">
  								<i class="fa fa-globe"></i>
  							</td>
  							<td valign="top" class="pl-1">Pengguna Online</td>
  							<td valign="top" class="pl-1 pr-1">:</td>
  							<td valign="top" class="pl-1">{{ $userOnline }}</td>
  						</tr>
  						<tr>
  							<td valign="top">
  								<i class="fa fa-user"></i>
  							</td>
  							<td valign="top" class="pl-1">Pengunjung Hari Ini</td>
  							<td valign="top" class="pl-1 pr-1">:</td>
  							<td valign="top" class="pl-1">{{ $visitorToday }}</td>
  						</tr>
  						<tr>
  							<td valign="top">
  								<i class="fa fa-users"></i>
  							</td>
  							<td valign="top" class="pl-1">Total Pengunjung</td>
  							<td valign="top" class="pl-1 pr-1">:</td>
  							<td valign="top" class="pl-1">{{ $visitors }}</td>
  						</tr>
  					</table>
          </div>
        </div><!-- /.col-lg-3 -->
        <div class="col-sm-12 col-md-6 col-lg-3 footer__widget footer__widget-newsletter">
          <h6 class="footer__widget-title">Stay Updated</h6>
          <div class="footer__widget-content">
            <form class="widget__newsletter-form">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subscribe Our Newsletter">
                <button type="submit" class="form__submit"><i class="fa fa-long-arrow-right"></i></button>
              </div>
            </form>
            <p>Don’t miss to follow us & subscribe to our new feeds, or you can follow us!</p>
            <div class="social__icons">
              @foreach($getsosmed as $sosmed)
              <a href="{{$sosmed->url}}" title="{{$sosmed->name}}"><i class="fa {{$sosmed->icon}}"></i></a>
              @endforeach
            </div><!-- /.social-icons -->
          </div>
        </div><!-- /.col-lg-3 -->
      </div>
    </div><!-- /.container -->
  </div><!-- /.footer-top -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
          <div class="footer__copyright">
            <span>&copy; 2021 Dinas Komunikasi dan Informatika Kabupaten Subang</a>
          </div>
        </div>
      </div>
    </div><!-- /.container -->
  </div><!-- /.Footer-bottom -->
</footer><!-- /.Footer -->
