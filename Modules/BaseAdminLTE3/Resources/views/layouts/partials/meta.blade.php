<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- META  -->
<title>@yield('title',config('app.name'))</title>
<meta name="keywords" content="{{ config('app.keywords') }}" />
<meta name="description" content="@yield('description',config('app.description'))" />
<!--OPENGRAPH -->
<meta property="og:title" content="@yield('title',config('app.name'))" />
<meta property="og:description" content="@yield('description',config('app.description'))" />
<meta property="og:type" content="website" />

<meta property="og:locale" content="{{ get_locate() }}" />
<meta property="og:site_name" content="@yield('site_name',config('app.name'))" />
{{--<meta property="fb:app_id" content="462947840579804" />--}}
<meta property="og:image" content="@yield('image',asset(config('app.img.social.user')))" />
<meta property="og:image:url" content="@yield('image',asset(config('app.img.social.user')))" />
@section('section_width')
    <meta property="og:image:width" content="@yield('width',config('app.img.social.width'))" />
@show

@section('section_height')
    <meta property="og:image:height" content="@yield('height',config('app.img.social.height'))" />
@show

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
