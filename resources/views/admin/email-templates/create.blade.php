@extends('admin.layouts.index')
@section('title','Add Email Template')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-mail-line me-1"></i>
                    Create Email Template
                </h5>
                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                {!! html()->form('POST', route('admin.email-templates.store'))->id('email-template-create-form')->open() !!}
                    @include('admin.email-templates.form')
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
@endsection
