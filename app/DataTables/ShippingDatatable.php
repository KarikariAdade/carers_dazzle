<?php

namespace App\DataTables;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingDatatable extends DataTable
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
            ->editColumn('region_id', function ($query){
                return $query->getRegion->name;
            })
            ->editColumn('town_id', function ($query){
                return $query->getTown->name;
            })
            ->editColumn('amount', function ($query){
                return 'GHS '.number_format($query->amount, 2);
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->editColumn('is_default', function ($query){
                return $query->is_default == false ? '<span class="badge badge-danger shadow-danger">Not Default</span>' : '<span class="badge badge-success shadow-success">Default</span>';
            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                if ($query->is_default == false){
                    $output .= '<a href="'.route('product.shipping.set.default', $query->id).'" title="Set as Default" id="setDefaultShipping" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-stamp"></i></a>
                        ';
                }
                $output .= '
                        <a href="'.route('product.shipping.update', $query->id).'" title="Edit Shipping Charge" id="updateShipping" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.shipping.delete', $query->id).'" title="Delete Shipping Charge" id="deleteShipping" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';

                return $output;
            })->rawColumns(['action', 'is_default']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Shipping $model
     * @return Builder
     */
    public function query(Shipping $model)
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
            Column::make('region_id')->title('Region'),
            Column::make('town_id')->title('Town'),
            Column::make('amount'),
            Column::make('is_default')->title('Default'),
            Column::make('created_at')->title('Data Created'),
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
        return 'Shipping_' . date('YmdHis');
    }
}
