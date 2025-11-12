<div class="row">
    <div class="col-md-6">
        <div class="form-floating form-floating-outline mb-3">
            {!! html()->text('name')
                ->id('role-name')
                ->class('form-control')
                ->placeholder('Enter role name')
                ->required()
                ->attribute('maxlength', 255) !!}
            {!! html()->label('Role Name')->for('role-name') !!}
            @error('name')
                <div class="invalid-feedback d-block" id="name-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    {{-- Add more fields here if needed --}}
    <div class="mt-4">
        {!! html()->submit('Create Role')->class('btn btn-primary') !!}
    </div>
</div>

