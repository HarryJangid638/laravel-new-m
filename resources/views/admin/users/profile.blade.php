<x-layout.admin title="Profile">
    <!-- content-main start// -->
    @php
        $defaultImage = asset('assets/admin/imgs/people/avatar-2.png');
    @endphp
    <section class="content-main">
        <div class="row">
            <div class="col-12">
                <div class="content-header">
                    <h2 class="content-title">Edit Profile</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header bg-theme text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Basic</h4>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                <i class="icon material-icons md-reply"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! html()->modelForm(auth()->user(), 'POST', route('admin.profile'))->id('profile-form')->attribute('enctype', 'multipart/form-data')->open() !!}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        {!! html()->label('Name', 'name')->class('form-label') !!}
                                        {!! html()->text('name')->placeholder('Name')->class('form-control')->id('name') !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        {!! html()->label('Email', 'email')->class('form-label') !!}
                                        {!! html()->email('email')->placeholder('Email')->class('form-control')->id('email')->attribute('readonly', true) !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        {!! html()->label('Phone', 'phone')->class('form-label') !!}
                                        {!! html()->text('phone')->placeholder('Phone')->class('form-control')->id('phone') !!}
                                    </div>
                                </div>
                                @php

                                    $user = auth()->user();
                                    $fileData = $user->uploads->first();

                                    $file_path = ($fileData && file_exists(public_path('storage/'.$fileData->file_path))) ? asset('storage/'.$fileData->file_path) : asset('assets/admin/imgs/people/avatar-2.png');
                                @endphp
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        {!! html()->label('Profile Image', 'profile_image')->class('form-label') !!}
                                        <div class="d-flex flex-column align-items-start">
                                            <div id="profile-image-preview-wrapper" style="position: relative; display: inline-block;">
                                                <img id="profile-image-preview"
                                                     src="{{ old('profile_image_url', $file_path) }}"
                                                     alt="Profile Image"
                                                     style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd; cursor: pointer;">

                                                <span id="delete-profile-image"
                                                      style="position: absolute; top: 5px; right: 5px; display: none; cursor: pointer; background: rgba(255,255,255,0.9); border-radius: 50%; padding: 2px 5px; font-weight: bold; color: red; font-size: 16px;">
                                                    ×
                                                </span>
                                            </div>

                                            {!! html()->file('profile_image')->class('d-none')->id('profile_image') !!}
                                            <small class="form-text text-muted mt-2">Click the image to select a new profile picture.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-end">
                                {!! html()->submit('Update Profile')->class('btn btn-primary') !!}
                            </div>

                        {!! html()->form()->close() !!}
                    </div>
                </div>
                <!-- card end// -->
            </div>
        </div>
    </section>
    <!-- content-main end// -->
    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                handleImageUpload({
                    inputId: 'profile_image',
                    previewId: 'profile-image-preview',
                    deleteBtnId: 'delete-profile-image',
                    defaultImg: "{{ $defaultImage }}"
                });
            });

            $('#profile-form').submit(async function(e)
            {
                e.preventDefault();
                showLoader();
                const form = e.target;
                const formData = new FormData(form);
                const result = await sendRequest('post', form.action, formData, { 'Content-Type': false, 'Process-Data': false });

                if(result.success)
                {
                    toasterAlert('success', result.message);
                    // Optionally reload or update the page/fields
                }
                else
                {
                    toasterAlert('error', result.message);
                }
                hideLoader();
            });

        </script>
    @endpush
</x-layout.admin>
