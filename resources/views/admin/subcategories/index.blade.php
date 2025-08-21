<x-layout.admin title="Roles">
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Roles</h2>
                <p>Add, edit or delete a role</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            {!! $dataTable->table(['id' => 'role-table', 'class' => 'table table-bordered'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('styles')
        {{-- Yajra DataTables CSS (if needed, but usually included in layout) --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"/>
    @endpush
    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush
</x-layout.admin>
