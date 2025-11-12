<div class="d-inline-block">
    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon-base ri ri-more-2-line icon-20px"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end m-0" style="">
        @can('users.view')
        <li>
            <a href="javascript:void(0);" class="dropdown-item btn-show-user" data-id="{{ $user->id }}">
                <i class="ri ri-eye-line me-2"></i> View
            </a>
        </li>
        @endcan
        @can('users.edit')
        <li>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="dropdown-item">
                <i class="ri ri-edit-line me-2"></i> Edit
            </a>
        </li>
        @endcan
        @can('assign-permission.view')
            <li>
                <a href="{{ route('admin.users.assign_permission', $user->id) }}" class="dropdown-item">
                    <i class="ri ri-key-line me-2"></i> Assign Permission
                </a>
            </li>
        @endcan
        @can('users.delete')
        <div class="dropdown-divider"></div>
        <li>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline;">
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
