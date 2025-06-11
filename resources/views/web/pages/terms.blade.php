@extends('web.layouts.main')

{{-- @section('meta_robot', 'index, follow') --}}
{{-- @section('seo_title', $seo->title) --}}
{{-- @section('seo_description', $seo->description) --}}
{{-- @section('seo_url', route('web.home')) --}}

@section('content')
    <div>
        <div class="py-5"
            style="height: 100vh;background-position:center;background-size: cover;max-height: 100vh;background-image:url({{ asset('assets-web/images/temp/back-1.png') }})">
            <div class="container py-5">
                <div class="row py-5 align-items-center">
                    {{-- <div class="col-lg-12">
                        <h1 class="mb-5">
                            {{ $section->title }}
                        </h1> --}}
                    <div class="row">
                        <div class="col-lg-10">
                            {!! $section->text !!}
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
