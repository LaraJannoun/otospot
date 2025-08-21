{{-- <div id="top" class="header-row-top">
    @php
    $side_1 = $locale == "en"  ? 'Left' : 'Right';
    @endphp
    <div class="header-top-nav">
        <div class="container py-lg-1">
            <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
                <a href="/" class="navbar-brand d-flex w-50 mr-auto d-lg-block d-none">
                    <!-- <img class="logo-width" src="{{ asset('assets-web/images/logo/logo.svg') }}" alt="{{ env('APP_NAME') }}"> -->
                </a>
                <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingTopNavbar3">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse w-100">
                <div class="navbar-nav w-100 justify-content-center">
                    <p class="font-16 hvr-grow animate__animated animate__fadeIn{{$side_1}}">
                        {{trans('messages.opening_hours')}}
                    </p>
                </div>
                @php
                    $linkedin_link = $social_media->filter(function ($value, $key) {
                        return strtolower($value['title']) == 'linkedin';
                    })->first();

                    $facebook_link = $social_media->filter(function ($value, $key) {
                        return strtolower($value['title']) == 'facebook';
                    })->first();

                    $instagram_link = $social_media->filter(function ($value, $key) {
                        return strtolower($value['title']) == 'instagram';
                    })->first();

                    $twitter_link = $social_media->filter(function ($value, $key) {
                        return strtolower($value['title']) == 'twitter';
                    })->first();
                @endphp
                <ul class="nav navbar-nav ml-auto w-100 justify-content-end d-lg-flex d-none">
                    @if($linkedin_link)
                    <li class="list-inline-item mx-3">
                        <a href="{{$linkedin_link->link}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$linkedin_link->icon}}" alt="linkedin">
                        </a>
                    </li>
                    @endif
                    @if($instagram_link)
                    <li class="list-inline-item mx-3">
                        <a href="{{$instagram_link->link}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$instagram_link->icon}}" alt="instagram">
                        </a>
                    </li>
                    @endif
                    @if($twitter_link)
                    <li class="list-inline-item mx-3">
                        <a href="{{$twitter_link->link}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$twitter_link->icon}}" alt="twitter">
                        </a>
                    </li>
                    @endif
                    @if($facebook_link)
                    <li class="list-inline-item m-3-start">
                        <a href="{{$facebook_link->link}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$facebook_link->icon}}" alt="facebook">
                        </a>
                    </li>
                    @endif
                </ul>
                </div>
            </nav>
        </div>
    </div>
</div> --}}
<div class="header-row background-white">
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center-desktop py-5" style="z-index:99999999">
            <!-- <a href="/" class="navbar-brand d-flex w-50 mr-auto">Navbar 3</a> -->

            <a href="/" class="navbar-brand d-flex w-50 mr-auto hvr-grow">
                @if($locale == "en")
                <img class="logo-width" src="{{ asset('assets-web/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}">
                @elseif($locale =="ar")
                <img class="logo-width" src="{{ asset('assets-web/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse w-100 mobile-bg-white" id="collapsingNavbar3">
                <ul class="navbar-nav w-100 p-0">
                    <li class="nav-item hvr-grow">
                        <a class="nav-link" href="#top">{{trans('messages.home')}}</a>
                    </li>
                    <li class="nav-item hvr-grow">
                        <a class="nav-link" href="#our_features">{{trans('messages.our_features')}}</a>
                    </li>
                    <li class="nav-item hvr-grow">
                        <a class="nav-link" href="#why_otospot">{{trans('messages.why_otospot')}}</a>
                    </li>
                    <li class="nav-item hvr-grow">
                        <a class="nav-link" href="#services">{{trans('messages.testimonials')}}</a>
                    </li>
                    <li class="nav-item hvr-grow">
                        <a class="nav-link" href="#footer">{{trans('messages.get_in_touch')}}</a>
                    </li>
                </ul>
                {{-- <ul class="nav navbar-nav ml-auto w-100 justify-content-end language-on-mobile">
                    <li class="nav-item text-white font-weight-bold">
                        <a class="nav-link nav-link-2 @if($locale=='en') @endif" href="{{Route('web.home', 'en')}}">ENG</a>
                    </li>
                    <li class="nav-item text-white">
                        <a class="nav-link nav-link-3">|</a>
                    </li>
                    <li class="nav-item text-white font-weight-bold">
                        <a class="nav-link nav-link-2 @if($locale=='ar') @endif" href="{{Route('web.home', 'ar')}}">AR</a>
                    </li>
                </ul> --}}
            </div>
        </nav>
    </div>
</div>
@push('script')
<script>

</script>
@endpush
