<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 22/01/19
 * Time: 10:54
 */
?>
@if( \Request::has('jsFiles') || isset( $textoJs )  )
<!-- DEPENDENCY-JS -->
@foreach( \Request::get('jsFiles') AS $file )<script src="{{url($file,[], config('app.url_secure') == 1 ? true : false ).$cdnVersionJSCSS}}" type="text/javascript"></script>{{chr(10)}}@endforeach
@if( isset( $textoJs ) )<script>{!! $textoJs !!}</script> @endif
<!-- END DEPENDENCY-JS -->
@endif
