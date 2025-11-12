@extends('admin.layouts.index')
@section('title','Create Permission')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-shield-check-line me-1"></i>
                    Create Permission
                </h5>
                <div class="ms-auto">
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-light text-black">
                        <i class="ri ri-arrow-left-line"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                {!! html()->form('POST', route('admin.permissions.store'))->open() !!}
                    @include('admin.permissions.form')
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>
@endsection


