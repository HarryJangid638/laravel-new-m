@extends('admin.layouts.index')
@section('title','Permissions')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-primary">
                <h5 class="content-title card-title mb-0 text-white">Permissions</h5>
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-light text-black">
                    <i class="ri ri-add-line"></i> Create Permission
                </a>
            </div>
            <div class="card-datatable text-nowrap">
                {!! $dataTable->table(['id' => 'permission-table', 'class' => 'table table-bordered table-responsive'], true) !!}
            </div>
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
                            url: "{{ route('admin.permissions.show', ':id') }}".replace(':id', userId),
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


