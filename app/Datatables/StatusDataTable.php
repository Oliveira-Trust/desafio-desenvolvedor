<?php

namespace App\DataTables;

use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StatusDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Status $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Status $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     * TODO: Make exporting to Excel reflect friendlier data
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('statuses-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>')
                    ->orderBy(1, 'asc')
                    ->parameters([
                        'searchDelay' => 350,
                        'language' => [
                            'url' => url('vendor/dataTables/lang-pt.json')
                        ],
                    ])
                    ->buttons(
                        Button::make('excel')
                        ->text(__("Excel Export")),
                        Button::make('reload')
                        ->text(__("Reload"))
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name')
                ->title(__("status.columns.name"))
                ->footer(__("status.columns.name"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center'),
            Column::make('ref_table')
                ->title(__("status.columns.ref_table"))
                ->footer(__("status.columns.ref_table"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center'),
            Column::make('enable')
                ->title(__("status.columns.enable"))
                ->footer(__("status.columns.enable"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('getEnable(data)'),
            Column::make('status')
                ->title(__("status.columns.status"))
                ->footer(__("status.columns.status"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('getStatus(data)'),
            Column::make('created_at')
                ->title(__("status.columns.created_at"))
                ->footer(__("status.columns.created_at"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('moment(new Date(data)).format("DD/MM/YYYY HH:mm")'),
            Column::make('uuid', __("Action"))
                ->title(__("Action"))
                ->footer(__("Action"))
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width('120px')
                ->addClass('text-center')
                ->render('\'<a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="editData(this)" data-uuid="\' + data + \'">'. __("Edit") .'</a><a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteData(this)" data-uuid="\' + data + \'">'. __("Delete") .'</a>\''),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Status_List_' . date('YmdHis');
    }
}