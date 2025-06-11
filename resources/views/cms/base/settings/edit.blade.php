@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{ $page_info['title'] }}</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('cms.components.alert', ['with' => 'status', 'bg' => 'success'])

                    <form method="post" action="{{ route('admin.'.$page_info['link']) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('put')

                        {{-- Android App --}}
                        @include('cms.components.inputs.text', ['label' => 'Android App', 'name' => 'android_app'])

                        {{-- Apple App --}}
                        @include('cms.components.inputs.text', ['label' => 'Apple App', 'name' => 'apple_app'])

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection