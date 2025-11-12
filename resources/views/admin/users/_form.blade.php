<!-- Account -->
<div class="card-body">
    <x-image-upload
        mode="single"
        name="avatar"
        label="Profile Picture"
        :value="isset($user) && $user->avatar ? asset('storage/'.$user->avatar) : ''"
        :existingId="isset($user) ? $user->id : ''"
        accept="image/*"
    />
    <div class="d-flex align-items-start align-items-sm-center gap-6">
        {{-- <x-image-upload mode="single" name="profile_image" /> --}}
    </div>
</div>

{{-- Autofocus logic moved to JS for reliability --}}
<div class="row mt-1 g-5">
    <div class="col-md-6 form-control-validation">
        <div class="form-floating form-floating-outline">
            {!! html()->text('first_name')
                ->class('form-control' . ($errors->has('first_name') ? ' is-invalid' : ''))
                ->id('first_name')
                ->placeholder('Enter your first name')
                ->required() !!}
            {!! html()->label('First Name')->for('first_name') !!}
            @error('first_name')
                <div class="invalid-feedback d-block" id="first_name_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            {!! html()->text('last_name')
                ->class('form-control' . ($errors->has('last_name') ? ' is-invalid' : ''))
                ->id('last_name')
                ->placeholder('Enter your last name')
                ->required() !!}
            {!! html()->label('Last Name')->for('last_name') !!}
            @error('last_name')
                <div class="invalid-feedback d-block" id="last_name_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            {!! html()->email('email')
                ->class('form-control' . ($errors->has('email') ? ' is-invalid' : ''))
                ->id('email')
                ->placeholder('john.doe@example.com')
            !!}
            {!! html()->label('E-mail')->for('email') !!}
            @error('email')
                <div class="invalid-feedback d-block" id="email_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center">
        <div class="form-check form-switch mt-3">
            {!! html()->checkbox('status', isset($user) ? $user->status : true)
                ->class('form-check-input' . ($errors->has('status') ? ' is-invalid' : ''))
                ->id('status')
                ->value(1) !!}
            {!! html()->label('Active')->for('status')->class('form-check-label ms-2') !!}
            @error('status')
                <div class="invalid-feedback d-block" id="status_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
