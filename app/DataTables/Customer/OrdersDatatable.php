<?php

namespace App\DataTables\Customer;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDatatable extends DataTable
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
            ->editColumn('order_status', function ($query){
                return ucfirst($query->order_status);
            })
            ->editColumn('payment_type', function ($query){
                return ucfirst($query->payment_type);
            })
            ->editColumn('invoice_id', function ($query){
                return $query->getInvoice->invoice_number ?? "N/A";
            })
            ->editColumn('net_total', function ($query){
                return 'GHS '.number_format($query->net_total, 2);
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->editColumn('items', function ($query){
                $items = json_decode($query->meta, true);
                $item_count = 0;
                foreach ($items as $item => $row){
                    $item_count += $row['qty'];
                }

                return $item_count;

            })
            ->addColumn('action', function ($query){
//                return $query->getInovice->generateRoute() ?? 'N/A';
                $invoice_route = $query->getInvoice ? $query->getInvoice->generateRoute() : null;

                $output = '<div style="display: inline-flex;">';

                $output .= '<a href="'.$query->generateRoute().'" title="View Order" class=" mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        ';


                if ($query->getInvoice){
                    $output .= '<a href="'.$invoice_route.'" title="View Invoice" class=""><i class="fa mt-2 fa-file-alt"></i> </a>
                        </div>';
                }



                return $output;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     * @return Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery()->where('user_id', auth()->guard('web')->user()->id);
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
            Column::make('order_id'),
            Column::make('order_status'),
            Column::make('payment_type'),
            Column::make('invoice_id')->title('Invoice'),
            Column::make('net_total'),
            Column::computed('items'),
            Column::make('created_at')->title('Date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'Orders_' . date('YmdHis');
    }
}
