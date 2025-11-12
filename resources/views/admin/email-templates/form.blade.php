<div class="row">
    <div class="col-md-6">
        <div class="form-floating form-floating-outline mb-3">
            {!! html()->text('title')
                ->id('email-title')
                ->class('form-control')
                ->placeholder('Enter email title')
                ->required()
                ->attribute('maxlength', 255) !!}
            {!! html()->label('Title')->for('email-title') !!}
            @error('title')
                <div class="invalid-feedback d-block" id="title-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating form-floating-outline mb-3">
            {!! html()->text('subject')
                ->id('email-subject')
                ->class('form-control')
                ->placeholder('Enter email subject')
                ->required()
                ->attribute('maxlength', 255) !!}
            {!! html()->label('Subject')->for('email-subject') !!}
            @error('subject')
                <div class="invalid-feedback d-block" id="subject-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-floating form-floating-outline mb-3">
            {!! 
                html()->textarea('description')
                ->id('email-description')
                ->class('form-control')
                ->placeholder('Enter email description')
                ->required()
                ->attribute('rows', 8)
                ->attribute('style', 'height: 60px;') 
            !!}
            @error('description')
                <div class="invalid-feedback d-block" id="description-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mt-4">
        {!! html()->submit('Save Template')->class('btn btn-primary') !!}
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () 
        {
            CKEDITOR.replace('email-description', {
                height: 300
            });
        });
    </script>
@endpush
