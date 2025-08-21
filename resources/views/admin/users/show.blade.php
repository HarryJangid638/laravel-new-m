
<div class="container-xxl py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <div class="avatar avatar-lg me-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                        <i class="ri ri-user-3-line fs-2"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">{{ $user->name }}</h4>
                        <small class="text-white-50">User Details</small>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-muted">ID</dt>
                        <dd class="col-sm-8 mb-3">{{ $user->id }}</dd>

                        <dt class="col-sm-4 text-muted">Name</dt>
                        <dd class="col-sm-8 mb-3">{{ $user->name }}</dd>

                        <dt class="col-sm-4 text-muted">Email</dt>
                        <dd class="col-sm-8 mb-3">
                            <span class="badge bg-label-info text-dark px-2 py-1">
                                <i class="ri ri-mail-line me-1"></i>{{ $user->email }}
                            </span>
                        </dd>

                        <dt class="col-sm-4 text-muted">Created At</dt>
                        <dd class="col-sm-8 mb-3">
                            <i class="ri ri-calendar-line me-1"></i>
                            {{ $user->created_at->format('M d, Y H:i') }}
                        </dd>

                        <dt class="col-sm-4 text-muted">Updated At</dt>
                        <dd class="col-sm-8">
                            <i class="ri ri-time-line me-1"></i>
                            {{ $user->updated_at->format('M d, Y H:i') }}
                        </dd>
                    </dl>
                </div>
                <div class="card-footer bg-white border-top d-flex flex-wrap justify-content-between align-items-center px-4 py-3">
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary me-2">
                            <i class="ri ri-arrow-left-line me-1"></i> Back to List
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                            <i class="ri ri-edit-line me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
