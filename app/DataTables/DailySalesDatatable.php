<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DailySalesDatatable extends DataTable
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
            ->eloquent($query)
            ->editColumn('user_id', function ($query){
                return $query->getUser->name ?? 'N/A';
            })
            ->editColumn('created_at', function ($query){
                return date('h:iA', strtotime($query->created_at));
            })
            ->editColumn('invoice_id', function ($query){
                return $query->getInvoice->invoice_number ?? 'N/A';
            })
            ->editColumn('item_number', function ($query){
                $items = json_decode($query->meta, true);
                $item_count = 0;
                foreach ($items as $item => $row){
                    $item_count += $row['qty'];
                }

                return $item_count;

            })
            ->editColumn('order_status', function ($query){
                if($query->order_status === 'Paid'){
                    return '<span class="badge badge-success"> Paid </span>';
                }

                return '<span class="badge badge-danger">Not Paid</span>';

            })
            ->editColumn('net_total', function ($query){
                return 'GHS '.number_format($query->net_total, 2);
            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                $output .= '<a href="" title="View Order" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        ';
                if ($query->order_status === "Pending Payment"){
                    $output .= '<a href="" title="Make Payment" class="btn text-white table-btn btn-icon btn-primary btn-sm shadow-primary"><i class="fa mt-2 fa-file-alt"></i> Make Payment</a>
                        </div>';
                }
                return $output;
            })->rawColumns(['action', 'order_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return Builder[]|Collection
     */
    public function query(Order $model)
    {
        $model->newQuery()->whereDate('created_at', date('Y-m-d'))->orderBy('order_status', 'asc')->get();

        return $model->applyScopes();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('user_id')->title("Customer"),
            Column::make('order_id'),
            Column::computed('invoice_id')->title("Invoice Number"),
            Column::computed('item_number')->title("No. of Items"),
            Column::make('net_total'),
            Column::make('order_status'),
            Column::make('created_at')->title("Time Ordered"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'DailySales_' . date('YmdHis');
    }
}
