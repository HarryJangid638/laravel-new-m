@extends('admin.layouts.index')
@section('title','Users')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-settings-3-line me-1"></i>Settings
                </h5>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                {!! html()->form('POST', route('admin.settings.update'))->id('settings-form')->attribute('enctype', 'multipart/form-data')->open() !!}
                    @include('admin.settings._form')
                    <div class="mt-4">
                        {!! html()->submit('Save Settings')->class('btn btn-primary') !!}
                    </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            @foreach($settings as $group)
                @foreach($group as $setting)
                    @if($setting->type === 'image')
                        handleImageUpload({
                            inputId: 'setting-image-input-{{ $setting->id }}',
                            previewId: 'setting-image-preview-{{ $setting->id }}',
                            deleteBtnId: 'delete-setting-image-{{ $setting->id }}',
                            defaultImg: "{{ $setting->value ? asset($setting->value) : asset('assets/admin/imgs/people/avatar-2.png') }}"
                        });
                    @endif
                @endforeach
            @endforeach
        });
    </script>
@endpush
