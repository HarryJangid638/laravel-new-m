@extends('admin.layouts.index')
@section('title','Users')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="icon-base ri ri-group-line icon-sm me-2"></i>Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-lock-line icon-sm me-2"></i>Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-bookmark-line icon-sm me-2"></i>Billing & Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-notification-4-line icon-sm me-2"></i>Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-link-m icon-sm me-2"></i>Connections</a>
                        </li>
                    </ul>
                </div>
                <div class="card mb-6">
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                            <img src="../../assets/img/avatars/1.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="icon-base ri ri-upload-2-line d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-danger account-image-reset mb-4">
                                    <i class="icon-base ri ri-refresh-line d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form id="formAccountSettings" method="GET" onsubmit="return false">
                            <div class="row mt-1 g-5">
                                <div class="col-md-6 form-control-validation">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('firstName')->class('form-control')->id('firstName')->placeholder('Enter your first name')->attribute('autofocus', true)->required() !!}
                                        {!! html()->label('First Name')->for('firstName') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('lastName')->class('form-control')->id('lastName')->placeholder('Enter your last name')->required() !!}
                                        {!! html()->label('Last Name')->for('lastName') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->email('email')->class('form-control')->id('email')->placeholder('john.doe@example.com')->required() !!}
                                        {!! html()->label('E-mail')->for('email') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('organization')->class('form-control')->id('organization')->placeholder('Organization') !!}
                                        {!! html()->label('Organization')->for('organization') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            {!! html()->text('phoneNumber')->class('form-control')->id('phoneNumber')->placeholder('Phone Number') !!}
                                            {!! html()->label('Phone Number')->for('phoneNumber') !!}
                                        </div>
                                        <span class="input-group-text">US (+1)</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('address')->class('form-control')->id('address')->placeholder('Address') !!}
                                        {!! html()->label('Address')->for('address') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('state')->class('form-control')->id('state')->placeholder('State') !!}
                                        {!! html()->label('State')->for('state') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('zipCode')->class('form-control')->id('zipCode')->placeholder('Zip Code')->attribute('maxlength', 6) !!}
                                        {!! html()->label('Zip Code')->for('zipCode') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->select('country', [
                                            'Australia' => 'Australia',
                                            'Bangladesh' => 'Bangladesh',
                                            'Belarus' => 'Belarus',
                                            'Brazil' => 'Brazil',
                                            'Canada' => 'Canada',
                                            'China' => 'China',
                                            'France' => 'France',
                                            'Germany' => 'Germany',
                                            'India' => 'India',
                                            'Indonesia' => 'Indonesia',
                                            'Israel' => 'Israel',
                                            'Italy' => 'Italy',
                                            'Japan' => 'Japan',
                                            'Korea' => 'Korea, Republic of',
                                            'Mexico' => 'Mexico',
                                            'Philippines' => 'Philippines',
                                            'Russia' => 'Russian Federation',
                                            'South Africa' => 'South Africa',
                                            'Thailand' => 'Thailand',
                                            'Turkey' => 'Turkey',
                                            'Ukraine' => 'Ukraine',
                                            'United Arab Emirates' => 'United Arab Emirates',
                                            'United Kingdom' => 'United Kingdom',
                                            'United States' => 'United States'
                                        ], 'India')->class('select2 form-select')->id('country') !!}
                                        {!! html()->label('Country')->for('country') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->text('TagifyLanguageSuggestion')->class('form-control h-auto')->id('TagifyLanguageSuggestion')->placeholder('select language')->value('English') !!}
                                        {!! html()->label('Language')->for('TagifyLanguageSuggestion') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->select('timeZones', [
                                            '-12' => '(GMT-12:00) International Date Line West',
                                            '-11' => '(GMT-11:00) Midway Island, Samoa',
                                            '-10' => '(GMT-10:00) Hawaii',
                                            '-9' => '(GMT-09:00) Alaska',
                                            '-8' => '(GMT-08:00) Pacific Time (US & Canada)',
                                            '-8b' => '(GMT-08:00) Tijuana, Baja California',
                                            '-7' => '(GMT-07:00) Arizona',
                                            '-7b' => '(GMT-07:00) Chihuahua, La Paz, Mazatlan',
                                            '-7c' => '(GMT-07:00) Mountain Time (US & Canada)',
                                            '-6' => '(GMT-06:00) Central America',
                                            '-6b' => '(GMT-06:00) Central Time (US & Canada)',
                                            '-6c' => '(GMT-06:00) Guadalajara, Mexico City, Monterrey',
                                            '-6d' => '(GMT-06:00) Saskatchewan',
                                            '-5' => '(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
                                            '-5b' => '(GMT-05:00) Eastern Time (US & Canada)',
                                            '-5c' => '(GMT-05:00) Indiana (East)',
                                            '-4' => '(GMT-04:00) Atlantic Time (Canada)',
                                            '-4b' => '(GMT-04:00) Caracas, La Paz'
                                        ], '-12')->class('select2 form-select')->id('timeZones') !!}
                                        {!! html()->label('Timezone')->for('timeZones') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        {!! html()->select('currency', [
                                            'usd' => 'USD',
                                            'euro' => 'Euro',
                                            'pound' => 'Pound',
                                            'bitcoin' => 'Bitcoin'
                                        ], 'usd')->class('select2 form-select')->id('currency') !!}
                                        {!! html()->label('Currency')->for('currency') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="card">
                    <h5 class="card-header mb-1">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-6 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-6">
                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account" disabled="disabled">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

@endsection
