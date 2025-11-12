@extends('admin.layouts.index')
@section('title','Role Permissions')
@section('content')
<section class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
            <h5 class="content-title card-title mb-0 text-white">
                <i class="menu-icon icon-base ri ri-shield-keyhole-line me-1"></i>
                Role Permissions
            </h5>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-light text-black">
                <i class="ri ri-arrow-left-line"></i> Back to Roles
            </a>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                                // Group permissions by module for easier display
                                $grouped = $permissions->groupBy('module');
                                $actions = ['add', 'edit', 'view', 'delete'];
                            @endphp
                            @foreach($grouped as $module => $perms)
                                <tr>
                                    <td>{{ ucfirst($module) }}</td>
                                    @foreach($actions as $action)
                                        @php
                                            $perm = $perms->first(function($p) use ($module, $action)
                                            {
                                                $module = trim(strtolower(str_replace(' ', '-', $module)));
                                                return $p->slug === "{$module}.{$action}";
                                            });
                                        @endphp
                                        <td class="text-center">
                                            @if($perm)
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        value="{{ $perm->id }}"
                                                        class="form-check-input perm-toggle"
                                                        id="perm-toggle-{{ $perm->id }}"
                                                        data-permission-id="{{ $perm->id }}"
                                                        data-type="{{ $action }}"
                                                        {{ $role->permissions->contains($perm->id) ? 'checked' : '' }}
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
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function()
    {

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

        $('.perm-toggle').on('change', async function()
        {
            var $checkbox = $(this);
            var type = $checkbox.data('type');
            var roleId = '{{ $role->id }}';
            var checked = $checkbox.is(':checked') ? 1 : 0;
            var permissionId = $checkbox.data('permission-id');

            // Show overlay loader
            $('#perm-overlay-loader').show();

            try
            {
                const result = await axiosHelper.apiRequest({
                    url: "{{ route('admin.role-permissions.update', ['role_permission' => 0]) }}".replace('0', permissionId),
                    data: { role_id: roleId, permission_id: permissionId, type: type, value: checked, _method: 'PUT' },
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                toasterAlert('success', `Permission updated successfully.`);
            }
            catch (error)
            {
                $checkbox.prop('checked', !checked);
                let errorMsg = (error.response && error.response.data && error.response.data.message) ? error.response.data.message : 'An error occurred while updating the permission.';
                toasterAlert('error', errorMsg);
            }
            finally
            {
                // Hide overlay loader
                $('#perm-overlay-loader').hide();
            }
        });
    });
</script>
@endpush
