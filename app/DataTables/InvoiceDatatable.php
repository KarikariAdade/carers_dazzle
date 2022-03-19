<?php

namespace App\DataTables;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
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
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function ($query){
                return $query->getCustomer->name ?? 'N/A';
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y h:iA', strtotime($query->created_at));
            })
            ->editColumn('order_id', function ($query){
                return $query->getOrder->order_id ?? 'N/A';
            })
            ->editColumn('payment_type', function ($query){
                return ucfirst($query->payment_type);
            })
//            ->editColumn('item_number', function ($query){
//                $items = json_decode($query->meta, true);
//                $item_count = 0;
//                foreach ($items as $item => $row){
//                    $item_count += $row['qty'];
//                }
//
//                return $item_count;
//
//            })
            ->editColumn('net_total', function ($query){
                return number_format($query->getOrder->net_total, 2) ?? 'N/A';
            })
            ->editColumn('payment_status', function ($query){
                if($query->payment_status === 'Paid'){
                    return '<span class="badge badge-success shadow shadow-success"> Paid </span>';
                }

                return '<span class="badge badge-danger shadow shadow-danger">Not Paid</span>';

            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                if ($query->payment_status !== "Paid" && !empty(auth()->guard('admin')->user()->phone)){
                    $output .= '<a href="'.route('invoice.verify.payment', $query->id).'" title="Verify Payment" id="verifyPayment" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-stamp"></i></a>
                        ';
                }

                $output .= '<a href="' . route('invoice.details', $query->id) . '" title="View Invoice" class="btn table-btn btn-icon btn-primary btn-sm shadow-primary mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        ';
                if ($query->is_admin_created == 1) {
                    $output .= '
                        <a href="' . route('invoice.edit', $query->id) . '" title="Edit Invoice" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="' . route('invoice.delete', $query->id) . '" title="Delete Invoice" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';
                }

                return $output;
            })->rawColumns(['action', 'payment_status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query()
    {
        $query = Invoice::query()->orderBy('payment_status', 'ASC');

        $start_date = $this->request()->get('from');
        $end_date = $this->request()->get('to');
        $status = $this->request()->get('status');

        if (!empty($status) && empty($start_date) && empty($end_date)){
            $query->where('payment_status', $status);
        }

        if (empty($status) && !empty($start_date) && !empty($end_date)){
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        if (!empty($status) && !empty($start_date) && !empty($end_date)){
            $query->where('payment_status', $status)->whereBetween('created_at', [$start_date, $end_date]);
        }

        if (!empty($end_date) && empty($start_date) && empty($status)){
            $query->where('created_at', '<=', $end_date);
        }

        if (empty($end_date) && !empty($start_date) && empty($status)){
            $query->where('created_at', '>=', $end_date);
        }

        return $query->applyScopes();
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
            Column::make('invoice_number')->title("Invoice ID"),
            Column::make('order_id'),
            Column::make('user_id')->title('Customer'),
            Column::computed('payment_type'),
            Column::computed('payment_status')->title("Payment Status"),
            Column::computed('net_total'),
            Column::make('created_at'),
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
