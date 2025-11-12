@extends('admin.layouts.index')
@section('title','Users')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-1">Session</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">21,459</h4>
                                    <p class="text-success mb-1">(+29%)</p>
                                </div>
                                <small class="mb-0">Total Users</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                    <div class="icon-base ri ri-group-line icon-26px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-1">Paid Users</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-1">4,567</h4>
                                    <p class="text-success mb-1">(+18%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded">
                                    <div class="icon-base ri ri-user-add-line icon-26px scaleX-n1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-1">Active Users</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-1">19,860</h4>
                                    <p class="text-danger mb-1">(-14%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded-3">
                                    <div class="icon-base ri ri-user-follow-line icon-26px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-1">Pending Users</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-1">237</h4>
                                    <p class="text-success mb-1">(+42%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded-3">
                                    <div class="icon-base ri ri-user-search-line icon-26px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">
                    <i class="menu-icon icon-base ri ri-group-line me-1"></i>Users
                </h5>
                <a href="{{ route('admin.users.create') }}" class="btn btn-light text-black">
                    <i class="ri ri-add-line"></i> Create User
                </a>
            </div>
            <div class="card-datatable text-nowrap">
                {!! $dataTable->table(['id' => 'user-table', 'class' => 'table table-bordered table-responsive'], true) !!}
            </div>
        </div>
        <!-- Dynamic Offcanvas for showing details (usable for any module) -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasShowDetails" aria-labelledby="offcanvasShowDetailsLabel">
            <div class="offcanvas-header border-bottom">
                <h5 id="offcanvasShowDetailsLabel" class="offcanvas-title">Details</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 h-100" id="show-details-offcanvas-body">
                <!-- Details will be loaded here dynamically via AJAX -->
                <div class="text-center py-5" id="show-details-loading" style="display:none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div id="show-details-content">
                    <!-- Content will be injected here -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    @push('scripts')
        {!! $dataTable->scripts() !!}
        <script>
            /**
             * Handles displaying user details in an offcanvas using AJAX.
             */
            (function($) {
                'use strict';

                /**
                 * Show user details in the offcanvas when the view button is clicked.
                 */
                $(document).on('click', '.btn-show-user', async function(event)
                {
                    event.preventDefault();

                    const userId = $(this).data('id');
                    const $offcanvas = $('#offcanvasShowDetails');
                    const $loading = $('#show-details-loading');
                    const $content = $('#show-details-content');

                    // Display loading spinner and clear previous content
                    $loading.show();
                    $content.empty();

                    // Show the offcanvas
                    const offcanvasInstance = bootstrap.Offcanvas.getOrCreateInstance($offcanvas[0]);
                    offcanvasInstance.show();

                    try
                    {
                        const result = await axiosHelper.apiRequest({
                            url: "{{ route('admin.users.show', ':id') }}".replace(':id', userId),
                            method: 'GET',
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });

                        $loading.hide();

                        const mainContent = $(result).find('.card').parent().html() || result;
                        $content.html(mainContent);
                    }
                    catch (error)
                    {
                        console.log(error ,' error');
                        $loading.hide();
                        $content.html('<div class="alert alert-danger">Unable to load user details. Please try again later.</div>');
                    }


                });

                /**
                 * Reset the offcanvas content and hide the loading spinner when closed.
                 */
                $('#offcanvasShowDetails').on('hidden.bs.offcanvas', function () {
                    $('#show-details-loading').hide();
                    $('#show-details-content').empty();
                });

            })(jQuery);
        </script>
    @endpush
@endsection
