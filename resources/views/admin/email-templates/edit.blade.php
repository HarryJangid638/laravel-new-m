@extends('admin.layouts.index')
@section('title','Edit Email Template')
@section('content')
    <section class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">Edit Email Template</h5>
                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-light text-black">
                    <i class="ri ri-arrow-left-line"></i> Back
                </a>
            </div>
            <hr class="my-0">
            <div class="card-body">
                {!! html()->modelForm($emailTemplate, 'PUT', route('admin.email-templates.update', $emailTemplate->id))->id('email-template-edit-form')->open() !!}
                    @include('admin.email-templates.form')
                {!! html()->form()->close() !!}
            </div>
        </div>
    </section>
@endsection
