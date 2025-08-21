<x-layout.admin title="Create Category">
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Create Category</h2>
                <p>Add a new category to the system</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {!! html()->form('POST', route('admin.categories.store'))->id('category-create-form')->open() !!}
                    <div class="row">
                        <div class="mb-3">
                            {!! html()->label('Category Name', 'category-name')->class('form-label') !!} <span class="text-danger">*</span>
                            {!! html()->text('name')
                                ->id('category-name')
                                ->class('form-control')
                                ->placeholder('Enter category name')
                                ->required()
                                ->attribute('maxlength', 255) !!}
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                        <div class="mb-3">
                            {!! html()->label('Description', 'category-description')->class('form-label') !!}
                            {!! html()->textarea('description')
                                ->id('category-description')
                                ->class('form-control')
                                ->placeholder('Enter category description')
                                ->attribute('rows', 3) !!}
                            <div class="invalid-feedback" id="description-error"></div>
                        </div>
                        <div class="mb-3">
                            {!! html()->label('Status', 'category-status')->class('form-label me-3') !!} <span class="text-danger">*</span>
                            <div class="form-check form-switch">
                                {!! html()->checkbox('status', true)
                                    ->id('category-status')
                                    ->class('form-check-input')
                                    ->value('active') !!}
                                {!! html()->label('Active', 'category-status')->class('form-check-label')->id('status-label') !!}
                            </div>
                            <div class="invalid-feedback" id="status-error"></div>
                        </div>
                        <div class="mt-4">
                            {!! html()->submit('Create Category')->class('btn btn-primary') !!}
                        </div>
                    </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
    @push('scripts')
    <script>
        $(document).ready(function ()
        {
            $('#category-create-form').submit(async function(e)
            {
                e.preventDefault();
                // Clear previous errors
                $('#name-error').text('');
                $('[name="name"]').removeClass('is-invalid');
                showLoader();

                const form = e.target;
                const formData = new FormData(form);
                const result = await sendRequest('post', form.action, formData, { 'Content-Type': false, 'Process-Data': false });

                if(result.success)
                {
                    toasterAlert('success', result.message || 'Category created successfully');
                    window.location.href = "{{ route('admin.categories.index') }}";
                }
                else if(result.errors)
                {
                    toasterAlert('error', result.message || 'Please fix the errors and try again.');
                }
                else
                {
                    toasterAlert('error', result.message || 'An error occurred.');
                }
                hideLoader();
            });
        });
    </script>
    @endpush
</x-layout.admin>
