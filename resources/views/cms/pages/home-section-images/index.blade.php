@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="row mt-5">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{ $page_info['title'] }}</h3>
                        </div>
                        <div class="col-auto text-right">
                            <a href="{{ route('admin.'.$page_info['link'].'.create') }}" class="btn btn-sm btn-primary">Add</a>
                            <a href="{{ route('admin.'.$page_info['link'].'.order') }}" class="btn btn-sm btn-warning">Order</a>
                        </div>
                    </div>
                </div>

                @if(session('status'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @endif

                <table class="table align-items-center table-flush datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Section</th>
                            <th scope="col" class="no-sort">Image</th>
                            <th scope="col">Alt</th>

                            <!-- <th scope="col" class="no-sort">Publish</th> -->

                            <th scope="col" class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            <td>{{ $row->home_section_id ? $row->HomeSection->slug : null }}</td>
                            @php
                            $info_fr = pathinfo($row->image);
                            $isvideo_fr= false;
                            if (isset($info_fr) && isset($info_fr["extension"]) && ($info_fr["extension"] == "mp4" || $info_fr["extension"] == "mov" || $info_fr["extension"] == "ogg" || $info_fr["extension"] == "qt")) {
                            $isvideo_fr = true;
                            }
                            @endphp
                            <td><img src="@if($isvideo_fr) {{asset('assets-cms/images/video.png')}} @else {{asset($row->image)}} @endif" class="img-thumbnail"></td>
                            <!-- <td>
                                @if($row->image)
                                <img src="{{ asset($row->image) }}" class="img-thumbnail">
                                @endif
                            </td> -->
                            <td>{{ substr(strip_tags($row->alt), 0, 20) }}...</td>

                            <!-- <td class="adjust-element">
                                <label class="custom-toggle mb-0">
                                    <input class="publish-js" type="checkbox" value="{{ $row->id }}" @if($row->publish) {{ "checked" }} @endif>
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </td> -->
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form action="{{ route('admin.'.$page_info['link'].'.destroy', $row) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <a class="dropdown-item" href="{{ route('admin.'.$page_info['link'].'.show', $row) }}">View</a>
                                            <a class="dropdown-item" href="{{ route('admin.'.$page_info['link'].'.edit', $row) }}">Edit</a>
                                            <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this record?') ? this.parentElement.submit() : ''">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection
@push('script')
<script type="text/javascript">
    $('.publish-js').change(function() {
        var $this = $(this);
        $.ajax({
            type: "post",
            url: "{{ route('admin.'.$page_info['link'].'.publish') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": $this.val()
            }
        });
    });
    </script>
@endpush