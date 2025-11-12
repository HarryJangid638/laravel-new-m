@extends('admin.layouts.index')
@section('title','Assign Permissions')
@section('content')
<section class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
            <h5 class="content-title card-title mb-0 text-white">
                <i class="menu-icon icon-base ri ri-key-line me-1"></i>
                Assign Permissions to User
            </h5>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light text-black">
                <i class="ri ri-arrow-left-line"></i> Back to Users
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="p-3">
                    <h6 class="mb-3">
                        <i class="ri ri-user-line me-1"></i>
                        User: <span class="fw-bold">{{ $user->name }} ({{ $user->email }})</span>
                    </h6>
                    <form id="user-permission-form" method="POST" action="{{ route('admin.users.store_permission', $user->id) }}">
                        @csrf
                        <div class="card-datatable text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th class="text-center">Add</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $grouped = $permissions->groupBy('module');
                                        $actions = ['add', 'edit', 'view', 'delete'];
                                        $userPermissionIds = $user->permissions->pluck('id')->toArray();
                                    @endphp
                                    @foreach($grouped as $module => $perms)
                                        <tr>
                                            <td>{{ ucfirst($module) }}</td>
                                            @foreach($actions as $action)
                                                @php
                                                    $perm = $perms->first(function($p) use ($module, $action)
                                                    {
                                                        $moduleSlug = trim(strtolower(str_replace(' ', '-', $module)));
                                                        return $p->slug === "{$moduleSlug}.{$action}";
                                                    });
                                                @endphp
                                                <td class="text-center">
                                                    @if($perm)
                                                        <div class="form-check form-switch d-flex justify-content-center">
                                                            <input
                                                                type="checkbox"
                                                                name="permissions[]"
                                                                value="{{ $perm->id }}"
                                                                class="form-check-input"
                                                                id="perm-toggle-{{ $perm->id }}"
                                                                data-permission-id="{{ $perm->id }}"
                                                                data-type="{{ $action }}"
                                                                {{ in_array($perm->id, $userPermissionIds) ? 'checked' : '' }}
                                                            >
                                                            <label class="form-check-label visually-hidden" for="perm-toggle-{{ $perm->id }}">
                                                                {{ ucfirst($action) }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="ri ri-save-line me-1"></i> Save Permissions
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Add overlay loader HTML if not present
        if ($('#perm-overlay-loader').length === 0)
        {
            $('body').append(`
                <div id="perm-overlay-loader" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;background:rgba(255,255,255,0.6);">
                    <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                        <div class="spinner-border text-primary" role="status" style="width:3rem;height:3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            `);
        }

        $('#user-permission-form').on('change', function(e)
        {
            e.preventDefault();
            var $form = $(this);
            $('#perm-overlay-loader').show();

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    toasterAlert('success', response.message || 'Permissions updated successfully.');
                },
                error: function(xhr) {
                    let errorMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'An error occurred while updating permissions.';
                    toasterAlert('error', errorMsg);
                },
                complete: function() {
                    $('#perm-overlay-loader').hide();
                }
            });
        });
    });
</script>
@endpush
