@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.partials', ['title' => 'Edit Record'])

<div class="container-fluid mt--7">
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
            @include('cms.components.alert', ['with' => 'status', 'bg' => 'success'])
            <form method="post" action="{{ route('admin.'.$page_info['link'].'.update', $row) }}" autocomplete="off">
                @csrf
                @method('put')

                {{-- English Title --}}
                @include('cms.components.inputs.text', ['label' => 'English Title', 'asterix' => true, 'name' => 'title_en', 'maxlength' => 255])

                {{-- Arabic Title --}}
                @include('cms.components.inputs.text', ['label' => 'Arabic Title', 'asterix' => true, 'name' => 'title_ar', 'maxlength' => 255])
                
                {{-- English Subtitle --}}
                @include('cms.components.inputs.text', ['label' => 'English Subtitle', 'asterix' => false, 'name' => 'subtitle_en', 'maxlength' => 255])
                
                {{-- Arabic Subtitle --}}
                @include('cms.components.inputs.text', ['label' => 'Arabic Subtitle', 'asterix' => false, 'name' => 'subtitle_ar', 'maxlength' => 255])
               
                {{-- English Text --}}
                @include('cms.components.inputs.textarea', ['label' => 'English Text', 'asterix' => true, 'name' => 'text_en', 'quill' => true])
                
                {{-- Arabic Text --}}
                @include('cms.components.inputs.textarea', ['label' => 'Arabic Text', 'asterix' => true, 'name' => 'text_ar', 'quill' => true])

                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4">Save</button>
                </div>
            </form>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection