<?php
namespace App\DataTables;
use Carbon\Carbon;
use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RoleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Role> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // Use a closure for the action column to avoid view lookup issues
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($role)
            {
                return view('admin.roles.partials.action', compact('role'))->render();
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at ? $role->created_at->format('d/m/Y H:i') : '';
            })
            ->setRowId('id')
            ->setRowClass(function ($role) 
            {
                // You can use id or loop index to decide
                return $role->id % 2 === 0 ? 'even' : 'odd';
            });
            ;
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Role>
     */
    public function query(Role $model): QueryBuilder
    {
        // Order by name descending to match the query in your debug output
        return $model->newQuery()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('role-table')
        ->columns($this->getColumns())
        ->minifiedAjax(route('admin.roles.index'))
        ->responsive(true)
        ->orderBy(1, 'desc') // order by name desc (column index 1)
        ->selectStyleSingle()
        ->buttons([
            Button::make('excel'),
            Button::make('csv'),
            Button::make('pdf'),
            Button::make('print'),
            Button::make('reset'),
            Button::make('reload')
        ])
        ->parameters([
            'initComplete' => 'function() { $("#role-table tfoot").remove(); }'
        ])
        ;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
            ->title('#')
            ->searchable(false)
            ->orderable(false)
            ->exportable(false)
            ->printable(true)
            ->width(30)
            ->addClass('text-center'),
            Column::make('name'),
            Column::make('created_at')->title('Created'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
