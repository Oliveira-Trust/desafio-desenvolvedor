<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
     * @param Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>')
                    ->orderBy(2, 'desc')
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
            Column::make('client.name')
                ->title(__("order.columns.client_id"))
                ->footer(__("order.columns.client_id"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center'),
            Column::make('status.status')
                ->title(__("order.columns.status_id"))
                ->footer(__("order.columns.status_id"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('getStatus(data)'),
            Column::make('created_at')
                ->title(__("order.columns.created_at"))
                ->footer(__("order.columns.created_at"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('moment(new Date(data)).format("DD/MM/YYYY HH:mm")'),
            Column::make('uuid', __("Action"))
                ->title(__("Action"))
                ->footer(__("Action"))
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
        return 'Order_List_' . date('YmdHis');
    }
}