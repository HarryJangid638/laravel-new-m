<div class="row">
    <div class="mb-5 col-md-6 form-password-toggle form-control-validation">
        <div class="input-group input-group-merge">
            <div class="form-floating form-floating-outline w-100">
                {!! html()->password('current_password')
                    ->class('form-control' . ($errors->has('current_password') ? ' is-invalid' : ''))
                    ->id('current_password')
                    ->placeholder('Current password')
                    ->attribute('autocomplete', 'current-password')
                !!}
                {!! html()->label('Current password')->for('current_password') !!}
                @error('current_password')
                    <div class="invalid-feedback d-block" id="current_password_error">{{ $message }}</div>
                @enderror
            </div>
            <span class="input-group-text cursor-pointer"><i class="icon-base ri ri-eye-off-line icon-20px"></i></span>
        </div>
    </div>
</div>
<div class="row g-5 mb-6">
    <div class="col-md-6 form-password-toggle form-control-validation">
        <div class="input-group input-group-merge">
            <div class="form-floating form-floating-outline w-100">
                {!! html()->password('password')
                    ->class('form-control' . ($errors->has('password') ? ' is-invalid' : ''))
                    ->id('password')
                    ->placeholder('New password')
                    ->attribute('autocomplete', 'new-password')
                !!}
                {!! html()->label('New password')->for('password') !!}
                @error('password')
                    <div class="invalid-feedback d-block" id="password_error">{{ $message }}</div>
                @enderror
            </div>
            <span class="input-group-text cursor-pointer"><i class="icon-base ri ri-eye-off-line icon-20px"></i></span>
        </div>
    </div>
    <div class="col-md-6 form-password-toggle form-control-validation">
        <div class="input-group input-group-merge">
            <div class="form-floating form-floating-outline w-100">
                {!! html()->password('password_confirmation')
                    ->class('form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''))
                    ->id('password_confirmation')
                    ->placeholder('Confirm new password')
                    ->attribute('autocomplete', 'new-password')
                !!}
                {!! html()->label('Confirm new password')->for('password_confirmation') !!}
                @error('password_confirmation')
                    <div class="invalid-feedback d-block" id="password_confirmation_error">{{ $message }}</div>
                @enderror
            </div>
            <span class="input-group-text cursor-pointer"><i class="icon-base ri ri-eye-off-line icon-20px"></i></span>
        </div>
    </div>
</div>
<h6 class="text-body">Password Requirements:</h6>
<ul class="ps-4 mb-0">
    <li class="mb-4">Minimum 8 characters long - the more, the better</li>
    <li class="mb-4">At least one lowercase character</li>
    <li>At least one number, symbol, or whitespace character</li>
</ul>
<div class="mt-6">
    {!! html()->button('Save changes')->type('submit')->class('btn btn-primary me-3') !!}
    {!! html()->button('Reset')->type('reset')->class('btn btn-outline-secondary') !!}
</div>
