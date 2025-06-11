@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.partials', ['title' => 'View Record'])

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
                    <ul class="list-unstyled">
                        <li>
                            <h4>Slug</h4>
                            <p>{{ $row->slug }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>Image</h4>
                            @if($row->image)
                            <img width="400" src="{{ asset($row->image) }}" class="img-thumbnail">
                            @endif
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>English Title</h4>
                            <p>{{ strip_tags($row->title_en) }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>Arabic Title</h4>
                            <p>{{ strip_tags($row->title_ar) }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>English subtitle</h4>
                            <p>{{ strip_tags($row->subtitle_en) }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>Arabic subtitle</h4>
                            <p>{{ strip_tags($row->subtitle_ar) }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>Created at</h4>
                            <p>{{ date('d M Y - h:i A', strtotime($row->created_at)) }}</p>
                        </li>
                        <hr class="my-4">
                        <li>
                            <h4>Updated at</h4>
                            <p>{{ date('d M Y - h:i A', strtotime($row->updated_at)) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection