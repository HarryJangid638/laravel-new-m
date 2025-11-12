@extends('admin.layouts.index')
@section('title','Add Role')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-shield-user-line me-1"></i>
                    Create Role
                </h5>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                {!! html()->form('POST', route('admin.roles.store'))->id('role-create-form')->open() !!}
                    @include('admin.roles.form')
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
@endsection
