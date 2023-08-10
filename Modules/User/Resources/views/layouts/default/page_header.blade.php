@section('page_header')
    @if (View::hasSection('page_header_title') || ($name = route_name()))
        <div class="content-header">
            <div class="container-fluid">
                <div class="row{{-- mb-2--}}">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('page_header_title',$name ?? null)</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @if (!Route::is('user::dashboard'))
                                <li class="breadcrumb-item"><a href="{{ route('site::index') }}"><i class="fa fa-home"></i></a></li>
                            @endif

                            @hasSection ('page_header_breadcrumb')
                                @yield('page_header_breadcrumb')
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    @endif
@show
