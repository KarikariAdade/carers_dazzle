<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDatatable extends DataTable
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
            ->editColumn('amount_type', function ($query) {
                return ucfirst($query->amount_type);
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->addColumn('action', function ($query){
                return '
                        <div style="display: inline-flex;">
                        <a href="'.route('product.coupon.update', $query->id).'" title="Edit Coupon: '.$query->name.'" id="updateCoupon" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.coupon.delete', $query->id).'" title="Delete Coupon: '.$query->name.'" id="deleteCoupon" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';
    });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Coupon $model
     * @return Builder
     */
    public function query(Coupon $model)
    {
        return $model->newQuery()->orderByDesc('id');
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
            Column::make('name'),
            Column::make('amount'),
            Column::make('amount_type'),
            Column::make('description'),
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
        return 'Coupon_' . date('YmdHis');
    }
}
