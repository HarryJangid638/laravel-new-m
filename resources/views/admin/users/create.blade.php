@extends('admin.layouts.index')
@section('title','Add User')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-group-line me-1"></i>Users
                </h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                
                {!! html()->form('POST', route('admin.users.store'))->id('user-create-form')->attribute('enctype', 'multipart/form-data')->open() !!}
                    @include('admin.users._form')
                    <div class="mt-4">
                        {!! html()->submit('Create User')->class('btn btn-primary') !!}
                    </div>
                {!! html()->form()->close() !!}

                
            </div>
        </div>
    </section>
@endsection
