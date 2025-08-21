<a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Edit">Edit
</a>
<form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this role?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
        Delete
    </button>
</form>
