@extends('web.layouts.main')

{{-- @section('meta_robot', 'index, follow') --}}
{{-- @section('seo_title', $seo->title) --}}
{{-- @section('seo_description', $seo->description) --}}
{{-- @section('seo_url', route('web.home')) --}}

@section('content')
<div>
    @php
    $side_1 = $locale =="en"  ? 'right' : 'left';
    $side_2 = $locale =="en"  ? 'left' : 'right';
    @endphp
    <div class="container-fluid p-0">
        <div id="slider" class="position-relative py-lg-5 py-2">
        {{-- <div id="slider" class="slider-top-images-container position-relative"> --}}
            @foreach ($sliders as $key => $slider)
                @include('web.components.slider-object', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 1, 'image_main_title'=>$slider->title, 'image_main_subtitle'=>$slider->subtitle])
            @endforeach
        </div>
        <img class="pos-abs-1" src="{{ asset('assets-web/images/app1.svg') }}" alt="Otospot"/>
        <img class="pos-abs-2" src="{{ asset('assets-web/images/app2.svg') }}" alt="Otospot"/>
        <img class="pos-abs-drive" src="{{ asset('assets-web/images/drive.svg') }}" alt="Otospot"/>
        <img class="pos-abs-smarter" src="{{ asset('assets-web/images/smarter.svg') }}" alt="Otospot"/>
        {{-- <div class="position-relative">
            <img class="pos-abs-1" src="{{ asset('assets-web/images/plant.svg') }}" alt="Otospot"/>
            <img class="pos-abs-2" src="{{ asset('assets-web/images/yellow-flower.svg') }}" alt="Otospot"/>
            <div class="intro-styling">
                <div class="container">
                    <div class="row py-md-5 justify-content-center">
                        <div class="col-lg-6 col-12 py-5 px-5 px-lg-0 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}" >
                            <div class="py-md-3 text-white font-18 font-weight-semibold">{!!$intro->text!!}</div>
                        </div>

                    </div>
                </div>
            </div>
            </div> --}}
    </div>
    <div id="our_features">
        <div id="intro" class="container-fluid pt-lg-5 position-relative">
            <h1 class="text-center pt-2 pb-4 font-weight-bold">OTOSPOT Features</h1>
            <div class="row py-lg-5 @if($locale == 'en') justify-content-between @else justify-content-end @endif">
                <div class="col-lg-5 offset-lg-1 p-right-2 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}">
                    <img class="features-icon hvr-grow aos-init aos-animate mb-3" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/icon-1.svg') }}" alt="otospot" />

                    <p class="h2 font-weight-bold">{{$about->title}}</p>
                    <p class="h1 font-weight-extrabold">{{$about->subtitle}}</p>
                    <div class="mb-3 mt-3"><h4>{!!$about->text!!}</h4></div>
                    {{-- <img class="image-height-dolphin hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/dolphin.svg') }}" alt="Almugheirah dolphin" /> --}}
                </div>
                <div class="col-lg-6 col-media-query margin-right-minus-10 pt-lg-0 pt-3">
                    <div class="slider-about-images-container aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}">
                        @foreach ($about->images as $key => $slider)
                            @include('web.components.slider-object-side', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 0])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="first" class="position-relative">
            {{-- <img class="pos-abs-3 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_2}}" src="{{ asset('assets-web/images/plant-2.svg') }}" alt="Otospot plant"/> --}}
            <div  class="container-fluid pt-5 ">
                <div class="row py-lg-5 justify-content-between">
                    <div class="col-lg-6 col-media-query margin-left-minus-10 order-2 order-lg-1 pt-lg-0 pt-3">
                        <div class="slider-about-images-container aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}">
                            @foreach ($dine->images as $key => $slider)
                                @include('web.components.slider-object-side', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 0])
                            @endforeach
                        </div>
                    </div>
                    <div class="@if($locale == 'en') col-lg-6 @else col-lg-5 offset-lg-1 @endif pt-lg-5 p-left-2 order-1 order-lg-2 z-index-2 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}">
                        <img class="features-icon hvr-grow aos-init aos-animate mb-3" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/icon-2.svg') }}" alt="otospot" />

                        <p class="h2 font-weight-bold">{{$dine->title}}</p>
                        @if($dine->subtitle) <p class="h1 pt-3 font-weight-extrabold">{{$dine->subtitle}}</p>@endif
                        <div class="mt-3">{!!$dine->text!!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="second" class="position-relative">
            {{-- <img class="pos-abs-4 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/pink-plant.svg') }}" alt="Otospot pink plant"/> --}}
            {{-- <img class="pos-abs-5 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_2}}" src="{{ asset('assets-web/images/orange-plant.svg') }}" alt="Otospot orange plant" /> --}}
            <div class="container-fluid pt-5 position-relative">
                <div class="row py-lg-5 @if($locale == 'en') justify-content-between @else justify-content-end @endif">
                    <div class="col-lg-5 offset-lg-1 pt-lg-5 p-right-2 z-index-2 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}">
                        <img class="features-icon hvr-grow aos-init aos-animate mb-3" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/icon-3.svg') }}" alt="otospot" />

                        <p class="h2 font-weight-bold">{{$shop->title}}</p>
                        @if($shop->subtitle) <p class="h1 font-weight-extrabold">{{$shop->subtitle}}</p>@endif
                        <div class="mt-3">{!!$shop->text!!}</div>
                    </div>
                    <div class="col-lg-6 col-media-query margin-right-minus-10 pt-lg-0 pt-3 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}">
                        <div class="slider-about-images-container">
                            @foreach ($shop->images as $key => $slider)
                                @include('web.components.slider-object-side', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 0])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="third" class="position-relative">
            {{-- <img class="pos-abs-6 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_2}}" src="{{ asset('assets-web/images/green-plant.svg') }}" alt="Otospot Green plant"/> --}}
            <div class="container-fluid pt-5 position-relative">
                <div class="row py-lg-5 justify-content-between">
                    <div class="col-lg-6  col-media-query margin-left-minus-10 order-2 order-lg-1 pt-lg-0 pt-3">
                        <div class="slider-about-images-container aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}">
                            @foreach ($play->images as $key => $slider)
                                @include('web.components.slider-object-side', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 0])
                            @endforeach
                        </div>
                    </div>
                    <div class="@if($locale == 'en') col-lg-6 @else col-lg-5 offset-lg-1 @endif pt-lg-5 p-left-2 order-1 order-lg-2 z-index-2 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}">
                        <img class="features-icon hvr-grow aos-init aos-animate mb-3" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/icon-4.svg') }}" alt="otospot" />

                        <p class="h2 font-weight-bold">{{$play->title}}</p>
                        @if($play->subtitle) <p class="h1 font-weight-extrabold">{{$play->subtitle}}</p>@endif
                        <div class="mt-3">{!!$play->text!!}</div>
                    </div>
                </div>
            </div>
        </div>
     {{--
    <div id="fourth" class="position-relative">
        <img class="pos-abs-7 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-up-{{$side_1}}" src="{{ asset('assets-web/images/yellow-plant.svg') }}" alt="Otospot yellow plant"/>
        <div class="container-fluid pt-5 position-relative">
            <div class="row py-lg-5 @if($locale == 'en') justify-content-between @else justify-content-end @endif">
                <div class="col-lg-5 offset-lg-1 pt-lg-5 p-right-2 z-index-2 aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}" >
                    <p class="h2 font-weight-bold">{{$unwind->title}}</p>
                    @if($unwind->subtitle) <p class="h1 font-weight-extrabold">{{$unwind->subtitle}}</p>@endif
                    <div class="mt-3">{!!$unwind->text!!}</div>
                </div>
                <div class="col-lg-6 col-media-query margin-right-minus-10 pt-lg-0 pt-3">
                    <div class="slider-about-images-container aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}">
                        @foreach ($unwind->images as $key => $slider)
                            @include('web.components.slider-object-side', ['image_order' => $key, 'image_source'=>$slider->image, 'text' => 0])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
    </div>
     <div id="why_otospot" class="purple-bg-pos my-2">
        {{-- <img class="pos-abs-8 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}" src="{{ asset('assets-web/images/tree.svg') }}" alt="Almugheirah tree"/> --}}
        {{-- <img class="pos-abs-9 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}"  src="{{ asset('assets-web/images/green-path.svg') }}" alt="Almugheirah green path"/> --}}
        {{-- <img class="pos-abs-10 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}" src="{{ asset('assets-web/images/red-flower.svg') }}" alt="Almugheirah red flower"/> --}}
        <div class="container py-5">
            <div class="row py-lg-3 justify-content-center" >
                <div class="col-lg-5 py-3 text-center">
                    {{-- <h5 class="text-white text-center pb-2 pt-4 font-weight-bold">{{trans('messages.why_otospot')}}?</h5> --}}
                    <h1 class="text-white pb-4 text-center font-weight-extrabold">{{trans('messages.why_otospot')}}?</h1>
                    {{-- <a target="_blank" href="https://goo.gl/maps/qgy9iXVargQpH9sR7">
                        <button type="button" class="primary-button cursor-pointer">{{trans('messages.visit_us')}}</button>
                    </a> --}}
                </div>
            </div>
            <div class="row py-lg-3 justify-content-center" >
                <div class="col-lg-6 text-center">
                    <h1 class="text-white text-center pb-2 pt-4 font-weight-bold">1000+</h5>
                    <h5 class="text-white pb-4 text-center font-weight-extrabold">Roadside Assistance Providers</h1>
                </div>
                <div class="col-lg-6 text-center">
                    <h1 class="text-white text-center pb-2 pt-4 font-weight-bold">2000+</h5>
                    <h5 class="text-white pb-4 text-center font-weight-extrabold">Speciality Garages & Shops</h1>
                </div>
                {{-- <div class="col-lg-3 text-center">
                    <h1 class="text-white text-center pb-2 pt-4 font-weight-bold">3+</h5>
                    <h5 class="text-white pb-4 text-center font-weight-extrabold">Insurance Partners</h1>
                </div> --}}
                {{-- <div class="col-lg-3 text-center">
                    <h1 class="text-white text-center pb-2 pt-4 font-weight-bold">100,000+</h5>
                    <h5 class="text-white pb-4 text-center font-weight-extrabold">Downloads</h1>
                </div> --}}
            </div>
        </div>
    </div>
    <div id="services" class="my-2">
        {{-- <img class="pos-abs-8 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}" src="{{ asset('assets-web/images/tree.svg') }}" alt="Almugheirah tree"/> --}}
        {{-- <img class="pos-abs-9 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}"  src="{{ asset('assets-web/images/green-path.svg') }}" alt="Almugheirah green path"/> --}}
        {{-- <img class="pos-abs-10 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}" src="{{ asset('assets-web/images/red-flower.svg') }}" alt="Almugheirah red flower"/> --}}
        <div class="container py-lg-5">
            <div class="row py-lg-5 justify-content-center" >
                <div class="col-lg-3 text-center">
                    <img class="services-icon" src="{{ asset('assets-web/images/icon-service-1.svg') }}" alt="otospot" />
                    <h5 class="text-center pt-2 pb-4 font-weight-semibold">User Friendly</h5>
                    <p class="pb-4 text-center">Manage all your car needs with simple taps. Our app is designed for easy and intuitive navigation.</p>
                </div>
                <div class="col-lg-3 text-center">
                    <img class="services-icon" src="{{ asset('assets-web/images/icon-service-2.svg') }}" alt="otospot" />
                    <h5 class="text-center pt-2 pb-4 font-weight-semibold">Transparency</h5>
                    <p class="pb-4 text-center">All insurance information & quotations displayed is a reflection of the policies provided by our partner brokers. Your purchased coverage is always saved in the app under your vehicle profile. </p>
                </div>
                <div class="col-lg-3 text-center">
                    <img class="services-icon" src="{{ asset('assets-web/images/icon-service-3.svg') }}" alt="otospot" />
                    <h5 class="text-center pt-2 pb-4 font-weight-semibold">Trusted Partners</h5>
                    <p class="pb-4 text-center">All information provided about garages and roadside assistance partners accurately reflects the services they offer. A garage is set as verified only if they meet certain standards of professionalism & service quality.</p>
                </div>
                <div class="col-lg-3 text-center">
                    <img class="services-icon" src="{{ asset('assets-web/images/icon-service-4.svg') }}" alt="otospot" />
                    <h5 class="text-center pt-2 pb-4 font-weight-semibold">Data Security</h5>
                    <p class="pb-4 text-center">We implement strict measures, such as data encryption, to prevent the loss or unauthorized use of your personal information.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="contact" class="purple-bg-pos">
        <img class="pos-abs-8 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_2}}" src="{{ asset('assets-web/images/tree.svg') }}" alt="Almugheirah tree"/>
        <img class="pos-abs-9 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}"  src="{{ asset('assets-web/images/green-path.svg') }}" alt="Almugheirah green path"/>
        <img class="pos-abs-10 hvr-grow aos-init aos-animate" data-aos-offset="0" data-aos-duration="1000" data-aos="fade-{{$side_1}}" src="{{ asset('assets-web/images/red-flower.svg') }}" alt="Almugheirah red flower"/>
        <div class="container py-5">
            <div class="row py-lg-3 justify-content-center" >
                <div class="col-lg-5 py-3 text-center">
                    <h5 class="text-white text-center pb-2 pt-4 font-weight-bold">{{trans('messages.see_you_in')}}</h5>
                    <h1 class="text-white pb-4 text-center font-weight-extrabold">{{trans('messages.al_mugheirah')}}</h1>
                    <a target="_blank" href="https://goo.gl/maps/qgy9iXVargQpH9sR7">
                        <button type="button" class="primary-button cursor-pointer">{{trans('messages.visit_us')}}</button>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@push('script')
<script>
 let scrollRef = 0;
  $(window).on("resize scroll", function () {
    // increase value up to 10, then refresh AOS
    scrollRef <= 10 ? scrollRef++ : AOS.refresh();
  });
  </script>
@endpush
