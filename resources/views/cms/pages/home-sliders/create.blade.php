@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.partials', ['title' => 'Add Record'])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{ $page_info['title'] }}</h3>
                        </div>
                        <div class="col-auto text-right">
                            <a href="{{ route('admin.'.$page_info['link'].'.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.'.$page_info['link'].'.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="px-lg-4">
                            {{-- Slug --}}
                            @include('cms.components.inputs.text', ['label' => 'Slug', 'asterix' => false, 'name' => 'slug', 'hint' => 'Please make sure to use unique slugs, dash separated. example: first-slider'])

                            {{-- Image --}}
                            @include('cms.components.inputs.image', ['label' => 'Image', 'name' => 'image', 'hint' => 'Optimal size ex: 1920 × 946 px'])

                            {{-- English Title --}}
                            @include('cms.components.inputs.text', ['label' => 'English Title', 'asterix' => true, 'name' => 'title_en'])
                            
                            {{-- Arabic Title --}}
                            @include('cms.components.inputs.text', ['label' => 'Arabic Title', 'asterix' => true, 'name' => 'title_ar', 'maxlength' => 255])

                            {{-- subtitle English --}}
                            @include('cms.components.inputs.text', ['label' => 'Subtitle English', 'asterix' => true, 'name' => 'subtitle_en', 'maxlength' => 255])
                            
                            {{-- subtitle Arabic --}}
                            @include('cms.components.inputs.text', ['label' => 'Subtitle Arabic', 'asterix' => true, 'name' => 'subtitle_ar', 'maxlength' => 255])
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection