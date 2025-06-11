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
                            <code>Sender ID: {{ Config::get('services.sms.sender_id') }}</code>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('cms.components.alert', ['with' => 'success', 'bg' => 'success'])

                    @include('cms.components.alert', ['with' => 'error', 'bg' => 'danger'])

                    <div class="row">
                        <div class="col-xl-6 mb-5 mb-xl-0">
                            <h6 class="heading-small text-muted mb-3">Bulk Notification</h6>

                            <form method="POST" action="{{ route('admin.'.$page_info['link'].'.bulk') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf

                                {{-- Message --}}
                                @include('cms.components.inputs.textarea', ['label' => 'Message', 'asterix' => true, 'name' => 'bulk_message'])

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Send</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6">
                            <h6 class="heading-small text-muted mb-3">Targeted Notification</h6>

                            <form method="POST" action="{{ route('admin.'.$page_info['link'].'.single') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf

                                {{-- Users --}}
                                @include('cms.components.inputs.select-multiple', ['label' => 'Users', 'asterix' => true, 'name' => 'users', 'rows' => $users, 'attribute' => 'full_name'])

                                {{-- Message --}}
                                @include('cms.components.inputs.textarea', ['label' => 'Message', 'asterix' => true, 'name' => 'targeted_message'])

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('cms.layouts.footers.auth')
</div>
@endsection
