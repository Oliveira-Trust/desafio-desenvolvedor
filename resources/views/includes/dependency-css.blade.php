@if( \Request::has('cssFiles') || isset( $textoCss ) )
    <!-- DEPENDENCY-CSS -->
    @foreach( \Request::get('cssFiles') AS $file )<link href="{{url($file,[], config('app.url_secure') == 1 ? true : false ).$cdnVersionJSCSS}}" rel="stylesheet">{{chr(10)}} @endforeach
    @if( isset( $textoCss ) )<style>{!! $textoCss !!}</style> @endif
    <!-- END DEPENDENCY-CSS -->
@endif
