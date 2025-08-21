@extends('admin.layouts.index')
@section('title','Add Role')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Create Role</h2>
                <p>Add a new role to the system</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {!! html()->form('POST', route('admin.roles.store'))->id('role-create-form')->open() !!}
                    <div class="row">
                        <div class="mb-3">
                            {!! html()->label('Role Name', 'role-name')->class('form-label') !!} <span class="text-danger">*</span>
                            {!! html()->text('name')
                                ->id('role-name')
                                ->class('form-control')
                                ->placeholder('Enter role name')
                                ->required()
                                ->attribute('maxlength', 255) !!}
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                        {{-- Add more fields here if needed --}}
                        <div class="mt-4">
                            {!! html()->submit('Create Role')->class('btn btn-primary') !!}
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
            $('#role-create-form').submit(async function(e)
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
                    toasterAlert('success', result.message || 'Role created successfully');
                    window.location.href = "{{ route('admin.roles.index') }}";
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
@endsection
