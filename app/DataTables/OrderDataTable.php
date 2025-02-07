<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($query) {
                return $query->user?->name;
            })
            ->addColumn('grand_total', function($query){
                return $query->grand_total.' '.strtoupper($query->currency_name);
            })
            ->addColumn('order_status', function($query){
                if($query->order_status === 'delivered'){
                    return '<span class="badge badge-success">DELIVERED</span>';
                }elseif($query->order_status === 'declined'){
                    return '<span class="badge badge-danger">DECLINED</span>';
                }else {
                    return '<span class="badge badge-warning">'.$query->order_status.'</span>';
                }
            })
            ->addColumn('payment_status', function($query){
                if(strtoupper($query->payment_status) == 'COMPLETED'){
                    return '<span class="badge badge-success">COMPLETED</span>';
                }elseif(strtoupper($query->payment_status) == 'PENDING'){
                    return '<span class="badge badge-warning">PENDING</span>';
                }else {
                    return '<span class="badge badge-danger">'.$query->payment_status.'</span>';
                }
            })
            ->addColumn('date', function($query){
                return date('d-m-Y', strtotime($query->created_at));
            })
            ->addColumn('action', function($query){

                $view = "<a href='".route('admin.orders.show', $query->id)."' class='btn btn-primary'><i
                class='fas fa-eye'></i></a>";
                $status = "<a href='javascript:;' class='btn btn-warning ml-2 order_status_btn' data-id='".$query->id."'><i
                class='fas fa-truck-loading' data-toggle='modal' data-target='#order_modal'></i></a>";

                $delete = "<a href='".route('admin.orders.destroy', $query->id)."' class='btn btn-danger delete-item ml-2'><i
                class='fas fa-trash'></i></a>";


                return $view.$status.$delete;
            })
            ->rawColumns(['order_status', 'payment_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->width(70)
                ->addClass('text-center'),
            Column::make('invoice_id')
                ->width(160)
                ->addClass('text-center'),
            Column::make('user_name')
                ->width(300),
            Column::make('product_qty')
                ->width(130)
                ->addClass('text-center'),
            Column::make('grand_total')
                ->width(130)
                ->addClass('text-center'),
            Column::make('order_status')
                ->width(150)
                ->addClass('text-center'),
            Column::make('payment_status')
                ->width(160)
                ->addClass('text-center'),
            Column::make('date')
                ->width(120),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
