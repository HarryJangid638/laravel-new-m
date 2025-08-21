<a href="javascript:void(0);"
   class="btn btn-sm btn-info d-inline-block btn-show-user"
   title="View"
   data-id="{{ $user->id }}">
    <i class="ri ri-eye-line"></i>
</a>
<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary d-inline-block" title="Edit">
    <i class="ri ri-edit-line"></i>
</a>
<form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
        <i class="ri ri-delete-bin-line"></i>
    </button>
</form>
