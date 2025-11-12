@extends('admin.layouts.index')
@section('title','Role')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-shield-user-line me-1"></i>
                    Roles
                </h5>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-light text-black">
                    <i class="ri ri-add-line"></i> Add New Role
                </a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-datatable text-nowrap">
                        {!! $dataTable->table(['id' => 'role-table', 'class' => 'datatables-basic table table-bordered table-responsive'], true) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('styles')
        {{-- Yajra DataTables CSS (if needed, but usually included in layout) --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"/>
    @endpush
    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection

