
<div class="container-xxl py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <div class="avatar avatar-lg me-3 bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Image" class="avatar-lg me-3 img-thumbnail rounded-circle" style="width:56px;height:56px;">
                        @else
                            <i class="ri ri-user-3-line fs-1"></i>
                        @endif
                    </div>
                    <div>
                        <h3 class="mb-0">{{ $user->name ?: '-' }}</h3>
                        <small class="text-white-50">User Details</small>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0 align-middle">
                            <tbody>
                                <tr>
                                    <th class="bg-light text-end" style="width: 20%;">ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">First Name</th>
                                    <td>
                                        <span class="fw-semibold">{{ $user->first_name ?: '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Last Name</th>
                                    <td>
                                        <span class="fw-semibold">{{ $user->last_name ?: '-' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Email</th>
                                    <td>
                                        {!! $user->email
                                            ? '<span class="badge bg-label-info text-dark px-2 py-1"><i class="ri ri-mail-line me-1"></i>' . e($user->email) . '</span>'
                                            : '<span class="text-muted">-</span>' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-end">Created At</th>
                                    <td>
                                        <i class="ri ri-calendar-line me-1"></i>
                                        {{ $user->created_at ? $user->created_at->format('M d, Y H:i') : '-' }}
                                    </td>
                                </tr>
                                {{-- You can add more fields here if needed --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top d-flex flex-wrap justify-content-between align-items-center px-4 py-3">
                    <div>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="ri ri-arrow-left-line me-1"></i> Back to List
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="ri ri-edit-line me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
