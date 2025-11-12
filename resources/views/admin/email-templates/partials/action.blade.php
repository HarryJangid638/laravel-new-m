<div class="d-inline-block">
    <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="icon-base ri ri-more-2-line icon-20px"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end m-0" style="">
        @can('email-templates.edit')
            <li>
                <a href="{{ route('admin.email-templates.edit', $emailTemplate->id) }}" class="dropdown-item">
                    <i class="ri ri-edit-line me-2"></i> Edit
                </a>
            </li>
        @endcan
    </ul>
</div>
