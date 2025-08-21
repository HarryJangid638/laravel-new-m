<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary" title="Edit">Edit
</a>
<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
        Delete
    </button>
</form>
