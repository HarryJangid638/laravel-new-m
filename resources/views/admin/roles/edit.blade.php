@extends('admin.layouts.index')
@section('title','Edit Role')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">Edit Role</h5>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                {!! html()->modelForm($role, 'PUT', route('admin.roles.update', $role->id))->id('role-edit-form')->open() !!}
                    @include('admin.roles.form')
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
@endsection
