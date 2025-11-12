<div class="row mt-1 g-5">
    <div class="col-md-6">
        <div class="form-floating form-floating-outline">
            {!! html()->text('module')->class('form-control')->id('module')->placeholder('Enter your module name')->required() !!}
            {!! html()->label('Module Name')->for('module') !!}
            @error('module')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>


