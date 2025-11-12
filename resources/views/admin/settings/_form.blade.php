@if(isset($settings) && count($settings))
    @php
        $tabIndex = 0;
        // Determine the active tab from the request or default to the first tab
        // Fix: get the first group key in a Collection-safe way
        $firstGroup = null;
        foreach($settings as $groupKey => $groupSettings) {
            $firstGroup = $groupKey;
            break;
        }
        $activeTab = request('active_tab') ?? Str::slug($firstGroup);
    @endphp
    <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
        @foreach($settings as $group => $groupSettings)
            @php
                $tabSlug = Str::slug($group);
            @endphp
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($activeTab === $tabSlug) active @endif"
                        id="tab-{{ $tabSlug }}-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-{{ $tabSlug }}"
                        type="button"
                        role="tab"
                        aria-controls="tab-{{ $tabSlug }}"
                        aria-selected="{{ $activeTab === $tabSlug ? 'true' : 'false' }}">
                    {{ $group }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="settingsTabContent">
        @foreach($settings as $group => $groupSettings)
            @php
                $tabSlug = Str::slug($group);
            @endphp
            <div class="tab-pane fade @if($activeTab === $tabSlug) show active @endif"
                 id="tab-{{ $tabSlug }}"
                 role="tabpanel"
                 aria-labelledby="tab-{{ $tabSlug }}-tab">
                <div class="row mt-1 g-5">
                    @foreach($groupSettings as $setting)
                        <div class="col-md-6 form-control-validation">
                            <div class="form-floating form-floating-outline mb-4">
                                @php
                                    $inputId = "setting-{$setting->key}";
                                    $inputName = "settings[{$setting->id}]";
                                    $inputValue = $setting->value;
                                @endphp

                                @switch($setting->type)
                                    @case('text')
                                        {!! html()->text($inputName)
                                            ->class('form-control' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                            ->id($inputId)
                                            ->placeholder($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))
                                            ->value($inputValue)
                                        !!}
                                        {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId) !!}
                                    @break

                                    @case('email')
                                        {!! html()->email($inputName)
                                            ->class('form-control' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                            ->id($inputId)
                                            ->placeholder($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))
                                            ->value($inputValue)
                                        !!}
                                        {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId) !!}
                                    @break

                                    @case('number')
                                        {!! html()->number($inputName)
                                            ->class('form-control' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                            ->id($inputId)
                                            ->placeholder($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))
                                            ->value($inputValue)
                                        !!}
                                        {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId) !!}
                                    @break

                                    @case('textarea')
                                        {!! html()->textarea($inputName)
                                            ->class('form-control' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                            ->id($inputId)
                                            ->placeholder($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))
                                            ->value($inputValue)
                                        !!}
                                        {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId) !!}
                                    @break

                                    @case('boolean')
                                        <div class="form-check form-switch mt-3">
                                            {!! html()->checkbox($inputName, (bool)$inputValue)
                                                ->class('form-check-input' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                                ->id($inputId)
                                                ->value(1)
                                            !!}
                                            {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId)->class('form-check-label ms-2') !!}
                                        </div>
                                    @break

                                    @case('image')
                                        <x-image-upload
                                            mode="single"
                                            name="{{ $inputName }}"
                                            label="{{ $setting->display_name ?? 'Setting File' }}"
                                            :value="($setting->uploads && $setting->uploads->first()) ? asset('storage/' . $setting->uploads->first()->file_path) : asset('assets/admin/imgs/people/avatar-2.png')"
                                            :existingId="($setting->uploads && $setting->uploads->first()) ? $setting->uploads->first()->id : ''"
                                            accept="image/*"
                                        />
                                    @break

                                    @default
                                        {!! html()->text($inputName)
                                            ->class('form-control' . ($errors->has($inputName) ? ' is-invalid' : ''))
                                            ->id($inputId)
                                            ->placeholder($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))
                                            ->value($inputValue)
                                        !!}
                                        {!! html()->label($setting->display_name ?? ucfirst(str_replace('_', ' ', $setting->key)))->for($inputId) !!}
                                @endswitch

                                @error($inputName)
                                    <div class="invalid-feedback d-block" id="{{ $inputId }}_error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <script>
        // Highlight and show the correct tab on page load and when switching tabs
        document.addEventListener('DOMContentLoaded', function () {
            // Listen for tab shown event to update the URL with the active tab
            document.querySelectorAll('#settingsTab button[data-bs-toggle="tab"]').forEach(function(tabBtn) {
                tabBtn.addEventListener('shown.bs.tab', function (event) {
                    const tabId = event.target.getAttribute('data-bs-target').replace('#tab-', '');
                    const url = new URL(window.location);
                    url.searchParams.set('active_tab', tabId);
                    window.history.replaceState({}, '', url);
                });
            });

            // If there is an active_tab in the URL, activate that tab
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('active_tab');
            if (activeTab) {
                const tabBtn = document.querySelector(`#settingsTab button[data-bs-target="#tab-${activeTab}"]`);
                if (tabBtn) {
                    new bootstrap.Tab(tabBtn).show();
                }
            }
        });
    </script>
@else
    <div class="alert alert-warning">
        No settings found to display.
    </div>
@endif