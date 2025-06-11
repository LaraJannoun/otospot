@extends('cms.layouts.main')

@section('content')
@include('cms.layouts.headers.cards')

<div class="container-fluid mt--7">
    <div class="card shadow mt-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">{{ $page_info['title'] }}</h3>
                </div>
                <div class="col-auto text-right">
                    @can('faqs-create')
                    <a href="{{ route('admin.'.$page_info['link'].'.create') }}" class="btn btn-sm btn-primary">Add</a>
                    @endcan
                    @can('faqs-order')
                    <a href="{{ route('admin.'.$page_info['link'].'.order') }}" class="btn btn-sm btn-warning">Order</a>
                    @endcan
                </div>
            </div>
        </div>

        @include('cms.components.alert', ['with' => 'status', 'bg' => 'success', 'class' => 'mx-4'])

        <table class="table align-items-center table-flush datatable">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Title</th>
                    @can('faqs-publish')
                    <th scope="col" class="no-sort">Publish</th>
                    @endcan
                    <th scope="col" class="no-sort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>{{ $row->title }}</td>
                    @can('faqs-publish')
                    <td class="adjust-element">
                        <label class="custom-toggle mb-0">
                            <input class="publish-js" type="checkbox" value="{{ $row->id }}" @if($row->publish) {{ "checked" }} @endif>
                            <span class="custom-toggle-slider rounded-circle"></span>
                        </label>
                    </td>
                    @endcan
                    <td class="text-right">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @can('faqs-view')
                                <a class="dropdown-item" href="{{ route('admin.'.$page_info['link'].'.show', $row) }}">View</a>
                                @endcan

                                @can('faqs-edit')
                                <a class="dropdown-item" href="{{ route('admin.'.$page_info['link'].'.edit', $row) }}">Edit</a>
                                @endcan

                                @can('faqs-delete')
                                <form action="{{ route('admin.'.$page_info['link'].'.destroy', $row) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this record?') ? this.parentElement.submit() : ''">
                                        Delete
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection

@can('faqs-publish')
@push('script')
<script type="text/javascript">

    $('.publish-js').change(function(){
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
@endcan