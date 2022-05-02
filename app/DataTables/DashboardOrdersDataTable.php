<?php

namespace App\DataTables;

use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Order;


class DashboardOrdersDataTable extends DataTable
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
                return date('l M d, Y', strtotime($query->created_at));
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
            ->editColumn('payment_type', function ($query){
                return ucfirst($query->payment_type);
            })
            ->editColumn('order_status', function ($query){
                if($query->order_status === 'Paid'){
                    return '<span class="badge badge-success shadow shadow-success"> Paid </span>';
                }

                return '<span class="badge badge-danger shadow shadow-danger">Not Paid</span>';

            })
            ->editColumn('net_total', function ($query){
                return 'GHS '.number_format($query->net_total, 2);
            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                $output .= '<a href="'.route('sales.order.details', $query->id).'" title="View Order" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        ';
                if (!empty($query->getInvoice)){
                    $output .= '<a href="'.route('invoice.details', $query->getInvoice->id).'" title="View Invoice" class="btn text-white table-btn btn-icon btn-primary btn-sm shadow-primary"><i class="fa mt-2 fa-file-alt"></i> View Invoice</a>
                        </div>';
                }
                return $output;
            })->rawColumns(['action', 'order_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DashboardOrdersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
//        return $model->newQuery();

        $start_date = $this->request()->get('start_month');
        $end_date = $this->request()->get('end_month');
        $condition = [
//            $start_date,
//            $end_date,

            Carbon::parse($start_date)->startOfDay(),

            Carbon::parse($end_date)->endOfDay(),

        ];

        if(!empty($start_date) && !empty($end_date)) {
            return $model->newQuery()->whereBetween('created_at', $condition);

        }


        else {
            return $model->newQuery();

        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dashboardordersdatatable-table')
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
            Column::make('payment_type'),
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
        return 'DashboardOrders_' . date('YmdHis');
    }
}
