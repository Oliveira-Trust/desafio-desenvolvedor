<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
class ProductDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'products.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->with('status')
            ->newQuery();
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
                        ->text(__("Add") . " " . __("product.name")),
                        Button::make('reload')
                        ->text(__("Reload")),
                        Button::make('create')
                        ->action("window.location = '".route('erase', ['model' => 'products'])."';")
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
            Column::make('name')
                ->title(__("product.columns.name"))
                ->footer(__("product.columns.name"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center'),
            Column::make('description')
                ->title(__("product.columns.description"))
                ->footer(__("product.columns.description"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('\'<a href="javascript:void(0);" class="btn btn-secondary" onclick="addModal(&apos;\' + full.name + \'&apos;, &apos;<h4>'. __("product.columns.description") .'</h4>\' + data + \'&apos;);">'.__("Click").'</a>\''),
            Column::make('price')
                ->title(__("product.columns.price"))
                ->footer(__("product.columns.price"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('formatMoneyBr(data)'),
            Column::make('image')
                ->title(__("product.columns.image"))
                ->footer(__("product.columns.image"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('\'<img height="120px" src="\'+ data + \'">\''),
            Column::make('status.status')
                ->title(__("product.columns.status_id"))
                ->footer(__("product.columns.status_id"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('getStatus(data)'),
            Column::make('created_at')
                ->title(__("product.columns.created_at"))
                ->footer(__("product.columns.created_at"))
                ->searchable(true)
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->render('moment(new Date(data)).format("DD/MM/YYYY HH:mm")')
        ];
    }
}
