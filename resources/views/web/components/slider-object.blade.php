<div class="slider-object">
    @php
    $info = pathinfo($image_source);
    $isvideo= false;
    if (isset($info) && $info["extension"] == "mp4" || $info["extension"] == "mov" || $info["extension"] == "ogg" || $info["extension"] == "qt") {
    $isvideo = true;
    }
    @endphp
    @if($isvideo)
    <video class="slider-image" loop muted>
        <source src="{{ asset($image_source) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    @else
    <img class="slider-image" src="{{ asset($image_source) }}" alt="{{isset($image_main_title) ? $image_main_title : 'MUGHEIRAH'}}" />
    @endif
    <!-- <div class="left-arrow"></div>
    <div class="right-arrow"></div> -->
    @if(isset($text) && $text == 1)
    {{-- <div class="slider-absolute-text text-center">
        <div class="slider-text mb-lg-3 mb-0 animate__animated animate__fadeInRight" >
            <h1 class="slider-title font-weight-bold">{{$image_main_title}}</h1>
            <div class="text-white slider-subtitle font-weight-extrabold">{{$image_main_subtitle}}</div>
        </div>
    </div> --}}
    {{-- <div class="mouse-wrapper middle d-lg-block d-none">
        <div class="mouse">
            <div class="scroll"></div>
        </div>
    </div> --}}
    @endif
</div>
