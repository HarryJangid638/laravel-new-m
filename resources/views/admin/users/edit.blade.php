@extends('admin.layouts.index')
@section('title','Edit User')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-group-line me-1"></i>
                    Edit User
                </h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="icon-base ri ri-group-line icon-sm me-2"></i>Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-lock-line icon-sm me-2"></i>Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-bookmark-line icon-sm me-2"></i>Billing & Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-notification-4-line icon-sm me-2"></i>Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);"><i class="icon-base ri ri-link-m icon-sm me-2"></i>Connections</a>
                        </li>
                    </ul>
                </div>
                {!! html()->modelForm($user, 'PUT', route('admin.users.update', $user->id))->id('user-edit-form')->attribute('enctype', 'multipart/form-data')->open() !!}
                    @include('admin.users._form')
                    <div class="mt-4">
                        {!! html()->submit('Update User')->class('btn btn-primary') !!}
                    </div>
                {!! html()->form()->close() !!}

                <!-- Change Password -->
                <div class="card mb-6">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body pt-1">
                        {!! html()->form('POST', route('admin.users.change_password.update', $user->id))->id('formAccountSettings')->open() !!}
                            @include('admin.users._change-password-form')
                        {!! html()->form()->close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
