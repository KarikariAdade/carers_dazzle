<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
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
            ->editColumn('brand_id', function ($query){
                return $query->getBrand->name ?? 'N/A';
            })
            ->editColumn('category_id', function ($query){
                return $query->getCategory->name ?? 'N/A';
            })
            ->editColumn('shelf_id', function ($query){
                return $query->getSubCategory->name ?? 'N/A';
            })
            ->editColumn('price', function ($query){
                return 'GHS '.number_format($query->price, 2);
            })
            ->addColumn('action', function ($query){
                return '
                        <div style="display: inline-flex;">
                        <a href="'.route('product.edit', $query->id).'" title="Edit Product" id="updateProduct" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.delete', $query->id).'" title="Delete Delete" id="deleteProduct" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->orderBy('id', 'desc');
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
            Column::make('category_id')->title('Category'),
            Column::make('brand_id')->title('Brand'),
            Column::make('shelf_id')->title('SubCategory'),
            Column::make('price'),
            Column::make('quantity'),
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
        return 'Product_' . date('YmdHis');
    }
}
