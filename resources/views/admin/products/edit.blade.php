@extends('admin.layouts.index')
@section('title','Products')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">Edit Product</h5>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light text-black"><i class="ri ri-arrow-left-line"></i> Back</a>
            </div>
            <div class="card-body pt-0">
                <form id="productEditForm" method="POST" action="{{ route('admin.products.update', $product->id) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.products._form')
                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary me-3">Update</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


