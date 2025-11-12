@extends('admin.layouts.index')
@section('title','Products')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <h5 class="content-title card-title mb-0">Products</h5>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="ri ri-add-line"></i> Create Product
                </a>
            </div>
            <div class="card-datatable text-nowrap">
                {!! $dataTable->table(['id' => 'product-table', 'class' => 'table table-bordered table-responsive'], true) !!}
            </div>
        </div>
    </div>
    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection


