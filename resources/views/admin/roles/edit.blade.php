@extends('admin.layouts.index')

@section('title','Edit Role')
@section('content')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Edit Role</h2>
                <p>Update the role details</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {!! html()->modelForm($role, 'PUT', route('admin.roles.update', $role->id))->id('role-edit-form')->open() !!}
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
                            {!! html()->submit('Update Role')->class('btn btn-primary') !!}
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
            $('#role-edit-form').submit(async function(e)
            {
                e.preventDefault();
                // Clear previous errors
                showLoader();

                const form = e.target;
                const formData = new FormData(form);
                // Laravel expects _method=PUT for PUT requests via AJAX
                formData.append('_method', 'PUT');
                const result = await sendRequest('post', form.action, formData, { 'Content-Type': false, 'Process-Data': false });

                if(result.success)
                {
                    toasterAlert('success', result.message || 'Role updated successfully');
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
