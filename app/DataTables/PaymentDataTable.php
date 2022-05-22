<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Order;


class PaymentDataTable extends DataTable
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

            ->editColumn('invoice_id' , function ($query) {

                if(!empty($query->invoice_id)) {

                    $invoice_id = Invoice::query()->where('id', $query->invoice_id)->first();

                    return $invoice_id->invoice_number;
                }

            })

            ->editColumn('order_id' , function ($query) {

                if(!empty($query->order_id)) {

                    $order_id = Order::query()->where('id', $query->order_id)->first();

                    return $order_id->order_id;
                }

            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->editColumn('status', function ($query){
                if($query->status === 'success'){
                    return '<span class="badge badge-success shadow shadow-success"> Successful </span>';
                }
                elseif ($query->status === 'failed') {
                    return '<span class="badge badge-danger shadow shadow-danger">Failed</span>';

                }

            })->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PaymentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
    {

        $start_date = $this->request()->get('start_month');
        $end_date = $this->request()->get('end_month');


        if ( !empty($start_date) && !empty($end_date) ) {

            $query = $model->newQuery()->whereBetween('created_at',[$start_date, $end_date] );


        }

        else{

            $query = $model->newQuery();

        }

        return $query;


    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('paymentdatatable-table')
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

            Column::make('order_id'),
            Column::make('invoice_id'),
            Column::make('reference_id'),
            Column::make('status'),
            Column::make('created_at')->title("Payment Date"),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Payment_' . date('YmdHis');
    }
}
