<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ env('APP_NAME') }} | {{ $page_title }}</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

	{{-- <link rel="canonical" href="{{ URL::current() }}"> --}}
	{{-- <meta name="robots" content="@if(View::hasSection('meta_robot'))@yield('meta_robot')@endif"> --}}

	{{-- Primary Meta Tags --}}
	<meta name="title" content="{{env('APP_NAME')}}">
	<meta name="description" content="Otospot is a one-stop shop for all your vehicle needs. From purchasing insurance policies to accessing 24/7 roadside assistance, finding the nearest maintenance specialist, and more, we put the power of automotive management at your fingertips.">
	<meta property="image" content="{{ asset('assets-web/images/favicon/apple-touch-icon.png') }}">
    <meta name="author" content="{{env('APP_NAME')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	{{-- <meta name="robots" content="noindex"> --}}
	{{-- Open Graph / Facebook --}}
	<meta property="og:type" content="website">
	{{--<meta property="og:url" content="@if(View::hasSection('url'))@yield('url')@else{{ route('web.home', $locale) }}@endif"> --}}
	<meta property="og:title" content="{{env('APP_NAME')}}">
	<meta property="og:description" content="Otospot is a one-stop shop for all your vehicle needs. From purchasing insurance policies to accessing 24/7 roadside assistance, finding the nearest maintenance specialist, and more, we put the power of automotive management at your fingertips.">
	<meta property="og:image" content="{{ asset('assets-web/images/favicon/apple-touch-icon.png') }}">
	{{-- Twitter --}}
	<meta property="twitter:card" content="summary_large_image">
	{{--<meta property="twitter:url" content="@if(View::hasSection('url'))@yield('url')@else{{ route('web.home', $locale) }}@endif"> --}}
	<meta property="twitter:title" content="{{env('APP_NAME')}}">
	<meta property="twitter:description" content="Otospot is a one-stop shop for all your vehicle needs. From purchasing insurance policies to accessing 24/7 roadside assistance, finding the nearest maintenance specialist, and more, we put the power of automotive management at your fingertips.">
	<meta property="twitter:image" content="{{ asset('assets-web/images/favicon/apple-touch-icon.png') }}">
	{{-- Favicon --}}
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets-web/images/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-web/images/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets-web/images/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('assets-web/images/favicon/site.webmanifest') }}">
	<link rel="mask-icon" href="{{ asset('assets-web/images/favicon/safari-pinned-tab.svg') }}" color="#1054FB') }}">
	<meta name="msapplication-TileColor" content="#1054FB">
	<meta name="theme-color" content="#1054FB">
	{{-- Fonts --}}
	@if($locale == 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-web/fonts/arabic/stylesheet.css') }}" />
    @else
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-web/fonts/national/stylesheet.css') }}" />
	@endif
	{{-- Core CSS Files --}}
	{{--@if(App::environment('local'))--}}
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-web/libraries/bootstrap-5.1.3/bootstrap.min.css') }}"/>
	{{--@else
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	@endif--}}
   	<link rel="stylesheet" type="text/css" href="{{ asset('assets-web/libraries/slick-1.8.1/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-web/libraries/slick-1.8.1/slick/slick-theme.css') }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	{{-- Pushed StyleSheets --}}
	@stack('stylesheets')
	{{-- Main CSS --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-web/css/main.css') }}"/>
	@if($locale == 'ar')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-web/css/main-ar.css') }}?v={{ env('CSS_MAIN') }}" />
    @endif
</head>
<body>
	{{-- Navbar --}}
	@include('web.layouts.header.navbar')

	{{-- Content --}}
	<main>
        {{-- <h1> Coming Soon..</h1> --}}
		@yield('content')
	</main>

	{{-- Footer --}}
	@include('web.layouts.footer.footer')

	{{-- Core JS Files --}}
	<script type="text/javascript" src="{{ asset('assets-web/libraries/jquery-3.6.0/jquery.min.js') }}"/></script>
	<script type="text/javascript" src="{{ asset('assets-web/libraries/bootstrap-5.1.3/bootstrap.min.js') }}"/></script>
	<script src="{{ asset('assets-web/libraries/slick-1.8.1/slick/slick.min.js') }}" type="text/javascript"/></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
		AOS.init({
			// once: true,
			startEvent: 'load'
		});
	</script>
	{{-- Pushed Scripts --}}
	@stack('scripts')
	{{-- Main JS --}}
	 @if($locale == 'ar')
	<script type="text/javascript" src="{{ asset('assets-web/js/main-ar.js') }}?v={{ env('JS_MAIN') }}"></script>
    @else
	<script type="text/javascript" src="{{ asset('assets-web/js/main.js') }}?v={{ env('JS_MAIN') }}"></script>
    @endif

</body>
</html>
