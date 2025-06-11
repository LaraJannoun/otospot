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
                            @can('roles-create')
                            <a href="{{ route('admin.'.$page_info['link'].'.create') }}" class="btn btn-sm btn-primary">Add</a>
                            @endcan
                        </div>
                    </div>
                </div>

                @include('cms.components.alert', ['with' => 'status', 'bg' => 'success', 'class' => 'mx-4'])

                <table class="table align-items-center table-flush datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col" class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        @can('roles-edit')
                                        <a class="dropdown-item" href="{{ route('admin.'.$page_info['link'].'.edit', $role) }}">Edit</a>
                                        @endcan
                                        @can('roles-delete')
                                        <form action="{{ route('admin.'.$page_info['link'].'.destroy', $role) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this admin?') ? this.parentElement.submit() : ''">
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
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection