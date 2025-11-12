
<div class="container-xxl py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <div>
                        <h3 class="mb-0">{{ $permission->module ?: '-' }}</h3>
                        <small class="text-white-50">Permission Details</small>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0 align-middle">
                            <tbody>
                                <tr>
                                    <th class="bg-light text-end" style="width: 20%;">ID</th>
                                    <td>{{ $permission->id }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Name</th>
                                    <td>
                                        <span class="fw-semibold">{{ $permission->name ?: '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Guard Name</th>
                                    <td>
                                        <span class="badge bg-label-info text-dark px-2 py-1">
                                            <i class="ri ri-shield-user-line me-1"></i>
                                            {{ $permission->guard_name ?: '-' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Created At</th>
                                    <td>
                                        <i class="ri ri-calendar-line me-1"></i>
                                        {{ $permission->created_at ? $permission->created_at->format('M d, Y H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Updated At</th>
                                    <td>
                                        <i class="ri ri-calendar-check-line me-1"></i>
                                        {{ $permission->updated_at ? $permission->updated_at->format('M d, Y H:i') : '-' }}
                                    </td>
                                </tr>
                                {{-- You can add more fields here if needed --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top d-flex flex-wrap justify-content-between align-items-center px-4 py-3">
                    <div>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="ri ri-arrow-left-line me-1"></i> Back to List
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">
                            <i class="ri ri-edit-line me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
