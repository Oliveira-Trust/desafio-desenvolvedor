<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
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
        $dataTable = new EloquentDataTable($query);

        return $dataTable
        ->addColumn('action', 'orders.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->with('status')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['title' => __("Action"), 'width' => '120px', 'printable' => false])
                    ->dom('<"row"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>')
                    ->orderBy(0, 'asc')
                    ->parameters([
                        'searchDelay' => 350,
                        'language' => [
                            'url' => url('vendor/dataTables/lang-pt.json')
                        ],
                    ])
                    ->buttons(
                        Button::make('create')
                        ->text(__("Add") . " " . __("order.name")),
                        Button::make('reload')
                        ->text(__("Reload")),
                        Button::make('create')
                        ->action("window.location = '".route('erase', ['model' => 'purchase_orders'])."';")
                        ->text(__("Erase"))
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
            Column::make('id')
                ->title(__("order.columns.id"))
                ->footer(__("order.columns.id"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('\'#\' + data'),
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
        ];
    }
}
