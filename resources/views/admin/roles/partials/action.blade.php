<div class="d-inline-block">
    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon-base ri ri-more-2-line icon-20px"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end m-0" style="">
        @can('roles.edit')
            <li>
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="dropdown-item">
                    <i class="ri ri-edit-line me-2"></i> Edit
                </a>
            </li>
        @endcan
        @can('role-permissions.view')
            <li>
                <a href="{{ route('admin.role-permissions.index', $role->id) }}" class="dropdown-item">
                    <i class="ri ri-shield-keyhole-line me-2"></i> Permissions
                </a>
            </li>
        @endcan
        @can('roles.delete')
            <div class="dropdown-divider"></div>
            <li>
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger delete-record btn-no-bg">
                        <i class="ri ri-delete-bin-line me-2"></i> Delete
                    </button>
                </form>
            </li>
        @endcan
    </ul>
</div>
