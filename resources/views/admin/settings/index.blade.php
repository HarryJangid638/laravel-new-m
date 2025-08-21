<x-layout.admin title="Settings">
    <section class="content-main">
        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">Settings</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-theme text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Settings</h4>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                <i class="icon material-icons md-reply"></i>Back
                            </a>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                        @php $first = true; @endphp
                        @foreach($settings as $group => $groupSettings)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link @if($first) active @endif"
                                        id="tab-{{ Str::slug($group) }}"
                                        data-bs-toggle="tab"
                                        data-bs-target="#tab-pane-{{ Str::slug($group) }}"
                                        type="button"
                                        role="tab"
                                        aria-controls="tab-pane-{{ Str::slug($group) }}"
                                        aria-selected="{{ $first ? 'true' : 'false' }}">
                                    {{ ucfirst($group) }}
                                </button>
                            </li>
                            @php $first = false; @endphp
                        @endforeach
                    </ul>
                    <div class="card-body">
                        {!! Html::modelForm([], 'POST', route('admin.settings.update'))->id('settings-form')->attribute('enctype', 'multipart/form-data')->open() !!}
                        <div class="tab-content mt-3" id="settingsTabContent">
                            @php $first = true; @endphp
                            @foreach($settings as $group => $groupSettings)
                                <div class="tab-pane fade @if($first) show active @endif"
                                    id="tab-pane-{{ Str::slug($group) }}"
                                    role="tabpanel"
                                    aria-labelledby="tab-{{ Str::slug($group) }}">
                                    <div class="row">
                                        @foreach($groupSettings as $setting)
                                            <div class="col-lg-6">
                                                <div class="mb-4">
                                                    {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)), "setting-{$setting->key}")->class('form-label') !!}
                                                    @switch($setting->type)
                                                        @case('text')
                                                            {!! html()->text("settings[{$setting->id}]")->class('form-control')->id("setting-{$setting->key}")->value($setting->value) !!}
                                                            @break
                                                        @case('email')
                                                            {!! html()->email("settings[{$setting->id}]")->class('form-control')->id("setting-{$setting->key}")->value($setting->value) !!}
                                                            @break
                                                        @case('number')
                                                            {!! html()->number("settings[{$setting->id}]")->class('form-control')->id("setting-{$setting->key}")->value($setting->value) !!}
                                                            @break
                                                        @case('textarea')
                                                            {!! html()->textarea("settings[{$setting->id}]")->class('form-control')->id("setting-{$setting->key}")->value($setting->value) !!}
                                                            @break
                                                        @case('boolean')
                                                            <div class="form-check form-switch">
                                                                {!! html()->checkbox("settings[{$setting->id}]")->class('form-check-input')->id("setting-{$setting->key}")->value(1)->checked((bool)$setting->value) !!}
                                                                {!! html()->label($setting->details ?? '', "setting-{$setting->key}")->class('form-check-label') !!}
                                                            </div>
                                                            @break
                                                        @case('image')
                                                            @php
                                                                $fileData = $setting->uploads->first();

                                                                $file_path = ($fileData && file_exists(public_path('storage/'.$fileData->file_path))) ? asset('storage/'.$fileData->file_path) : asset('assets/admin/imgs/people/avatar-2.png');
                                                            @endphp
                                                            <div class="d-flex flex-column align-items-start">
                                                                <div id="setting-image-preview-wrapper-{{ $setting->id }}" style="position: relative; display: inline-block;">
                                                                    <img id="setting-image-preview-{{ $setting->id }}"
                                                                         src="{{ $file_path }}"
                                                                         alt="Setting Image"
                                                                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid #ddd; cursor: pointer;">
                                                                    <span id="delete-setting-image-{{ $setting->id }}"
                                                                          style="position: absolute; top: 5px; right: 5px; display: none; cursor: pointer; background: rgba(255,255,255,0.9); border-radius: 50%; padding: 2px 5px; font-weight: bold; color: red; font-size: 16px;">
                                                                        ×
                                                                    </span>
                                                                </div>
                                                                {!! html()->file("settings[{$setting->id}]")->class('d-none')->id("setting-image-input-{$setting->id}") !!}
                                                                <small class="form-text text-muted mt-2">Click the image to select a new file.</small>
                                                            </div>
                                                            @break
                                                        @default
                                                            {!! html()->text("settings[{$setting->id}]")->class('form-control')->id("setting-{$setting->key}")->value($setting->value) !!}
                                                    @endswitch
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php $first = false; @endphp
                            @endforeach
                        </div>
                        <div class="mt-4 text-end">
                            {!! html()->submit('Save Settings')->class('btn btn-primary') !!}
                        </div>
                        {!! html()->form()->close() !!}
                    </div>
                </div>
                <!-- card end// -->
            </div>
        </div>
    </section>
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
</x-layout.admin>
