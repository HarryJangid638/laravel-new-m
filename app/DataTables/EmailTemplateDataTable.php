<?php
namespace App\DataTables;
use App\Models\EmailTemplate;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class EmailTemplateDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<EmailTemplate> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($emailTemplate)
            {
                return view('admin.email-templates.partials.action', compact('emailTemplate'))->render();
            })
            ->editColumn('created_at', function ($emailTemplate) 
            {
                return $emailTemplate->created_at ? $emailTemplate->created_at->format('d/m/Y H:i A') : '';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<EmailTemplate>
     */
    public function query(EmailTemplate $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('email-template-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->orderBy(1)
        ->responsive(true)
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
            'initComplete' => 'function() { $("#email-template-table tfoot").remove(); }'
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
            Column::make('title'),
            Column::make('subject'),
            Column::make('is_active'),
            Column::make('created_at'),
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
        return 'EmailTemplate_' . date('YmdHis');
    }
}
