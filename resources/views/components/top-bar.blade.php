<div class="collapse navbar-collapse" id="navbar-mobile">
    <ul class="nav navbar-nav mr-auto float-left">
        <li class="nav-item d-none d-md-block " style="padding-left: 10px">
            {{--<a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a>--}}
        </li>
    </ul>
    <ul class="nav navbar-nav float-right" style="z-index: 99999">
        <li class="dropdown dropdown-user nav-item top-bar-user">
            <a class="dropdown-toggle nav-link dropdown-user-link navbar-menu-top-sandwich" style="color: white" href="#" data-toggle="dropdown">
                <span class="mr-1">Olá,
                  <span class="user-name text-bold-700">{{$userName}}</span>
                </span>
            @if( is_int( sessionOpen( 'get', 'cashier_open' ) ) )
                <div class="rounded-circle float-right icon-top-pdv" onclick="document.location.href='{{route('pdv.balcony')}}'">
                    <img src="/assets/images/pdv-icon.png{{$cdnVersionJSCSS}}" width="35" height="35" alt="">
                </div>
            @endif
            </a>
        </li>
    </ul>
</div>
