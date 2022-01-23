<?php

namespace App\DataTables\Customer;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InvoiceDatatable extends DataTable
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
            ->editColumn('payment_status', function ($query){
                return ucfirst($query->payment_status);
            })
            ->editColumn('payment_type', function ($query){
                return ucfirst($query->payment_type);
            })
            ->editColumn('order_id', function ($query){
                return $query->getOrder->order_id ?? "N/A";
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->addColumn('action', function ($query){
                return '
                        <div style="display: inline-flex;">
                        <a href="'.$query->generateRoute().'" title="View Invoice" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-eye"></i> View</a>
                        <a href="'.$query->generatePrintRoute().'" title="Download Invoice" class="btn text-white table-btn btn-icon btn-primary btn-sm shadow-primary"><i class="fa mt-2 fa-download"></i> Download</a>
                        </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Invoice $model
     * @return Builder
     */
    public function query(Invoice $model)
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
            Column::make('invoice_number'),
            Column::make('payment_status'),
            Column::make('payment_type'),
            Column::make('order_id')->title('Order Number'),
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
        return 'Invoice_' . date('YmdHis');
    }
}
