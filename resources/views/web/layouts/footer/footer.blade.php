<div id="footer" class="position-relative footer">
    @php
    $side_1 = $locale =="en"  ? 'right' : 'Llft';
    @endphp
    <div class="container-md">
        <div class="row py-5 justify-content-center" >
            <div class="col-lg-4 text-center">
                <img class="footer-icon" src="{{ asset('assets-web/images/mobile.svg') }}" alt="otospot" />
                <p class="text-white text-center pb-2 pt-4 font-weight-bold">Customer Support</p>
                <p class="text-white pb-4 text-center font-weight-extrabold">+961 70 976 400</p>
            </div>
            <div class="col-lg-4 text-center">
                <img class="footer-icon" src="{{ asset('assets-web/images/pin.svg') }}" alt="otospot" />
                <p class="text-white text-center pb-2 pt-4 font-weight-bold">Location</p>
                <p class="text-white pb-4 text-center font-weight-extrabold">Saifi Tower, 8th Floor, Saifi, Beirut, Lebanon</p>
            </div>
            <div class="col-lg-4 text-center">
                <img class="footer-icon" src="{{ asset('assets-web/images/envelope.svg') }}" alt="otospot" />
                <p class="text-white text-center pb-2 pt-4 font-weight-bold">Email Address</p>
                <p class="text-white pb-4 text-center font-weight-extrabold">Support@otospot.app</p>
            </div>
        </div>
        <div class="row pb-5" >
            <div class="col-lg-12 py-lg-5 py-2" style="z-index: 9999999;">
                <div id="why_otospot" class="footer-bg-pos p-5 d-lg-flex d-none">
                    <div class="container py-5">
                        <div class="row py-lg-3 justify-content-center" >
                            <div class="col-lg-5 py-3 text-center">
                                <img class="pos-abs-drive-2" src="{{ asset('assets-web/images/drive.svg') }}" alt="Otospot"/>
                                <img class="pos-abs-smarter-2" src="{{ asset('assets-web/images/smarter.svg') }}" alt="Otospot"/>
                                {{-- <h5 class="text-white pb-4 text-center font-weight-extrabold">Drive</h5> --}}
                                {{-- <h1 class="text-white pb-4 text-center font-weight-extrabold">Smarter</h1> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-4">
        <div class="col-lg-3 py-lg-0 py-2" style="z-index: 9999999;">
                <a href="{{Route('web.home', 'en')}}">
                    <img class="logo-width" src="{{ asset('assets-web/images/logo/logo-white.svg') }}" alt="{{ env('APP_NAME') }}">
                </a>

            </div>
        <div class="col-lg-9 py-lg-0 py-2" style="z-index: 9999999;justify-content: end;display: flex;">
            <div class="social-media-footer-icons pt-lg-3">
                <ul class="list-inline mb-0 p-0">
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

                        $youtube_link = $social_media->filter(function ($value, $key) {
                            return strtolower($value['title']) == 'youtube';
                        })->first();

                        $android_link = $social_media->filter(function ($value, $key) {
                            return strtolower($value['title']) == 'android';
                        })->first();

                        $apple_link = $social_media->filter(function ($value, $key) {
                            return strtolower($value['title']) == 'apple';
                        })->first();
                    @endphp
                    {{-- @if($linkedin_link) --}}
                    <li class="list-inline-item">
                        <a href="{{$linkedin_link->link ?? null}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$linkedin_link->icon?? null}}" alt="linkedin">
                        </a>
                    </li>
                    {{-- @endif --}}
                    {{-- @if($instagram_link) --}}
                    <li class="list-inline-item mx-2">
                        <a href="{{$instagram_link->link?? null}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$instagram_link->icon?? null}}" alt="instagram">
                        </a>
                    </li>
                    {{-- @endif --}}
                    {{-- @if($twitter_link) --}}
                    {{-- <li class="list-inline-item mx-2">
                        <a href="{{$twitter_link->link?? null}}" target="_blank">
                            <img class="mr-2 image-15" src="{{$twitter_link->icon?? null}}" alt="twitter">
                        </a>
                    </li> --}}
                    {{-- @endif --}}
                    {{-- @if($facebook_link) --}}
                    <li class="list-inline-item mx-2">
                        <a href="{{$facebook_link->link?? null}}" target="_blank">
                            <img class="mr-2 image-20" src="{{$facebook_link->icon?? null}}" alt="facebook">
                        </a>
                    </li>
                    {{-- @endif --}}
                </ul>
            </div>
        </div>
        </div>

        <div class="row justify-content-center pb-4">
            <div class="col-lg-4">
                <p class="text-center font-15" style="vertical-align: middle;">
                @if($locale == "ar")
                {{trans('messages.rights_reserved')}} {{date("Y")}}
                   @else
                {{date("Y")}}, {{trans('messages.rights_reserved')}}
                @endif
                </p>
            </div>
        </div>
    </div>
</div>
