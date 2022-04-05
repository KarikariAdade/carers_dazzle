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
            ->editColumn('is_hot_deal', function ($query){
                return $query->is_hot_deal == true ? '<span class="badge badge-success shadow">Hot Deal</span>' : '<span class="badge badge-danger shadow">N/A</span>';
            })
            ->editColumn('is_featured', function ($query){
                return $query->is_featured == true ? '<span class="badge badge-success shadow">Featured</span>' : '<span class="badge badge-danger shadow">Not Featured</span>';
            })
            ->editColumn('is_active', function ($query){
                return $query->is_active == true ? '<span class="badge badge-success shadow">Active</span>' : '<span class="badge badge-danger shadow">Inactive</span>';
            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                if ($query->is_hot_deal == false){
                    $output .= '<a href="'.route('product.mark.hot', [$query->id, 'hot', 'not_raw']).'" id="markActive" title="Mark as Hot Deal" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-bell"></i></a>
                        ';
                }else{
                    $output .= '<a href="'.route('product.mark.hot', [$query->id, 'not_hot', 'not_raw']).'" id="markActive" title="Mark as Hot Deal" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-bell-slash"></i></a>
                        ';
                }

                if ($query->is_featured == false){
                    $output .= '<a href="'.route('product.mark.featured', [$query->id, 'mark_featured', 'not_raw']).'" id="markFeatured" title="Mark Featured" class="btn table-btn btn-icon btn-info btn-sm shadow-info mr-2"><i class="fa mt-2 fa-check-circle"></i></a>
                        ';
                }else{
                    $output .= '<a href="'.route('product.mark.featured', [$query->id, 'unmark_featured', 'not_raw']).'" id="markFeatured" title="Remove Feature" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-times-circle"></i></a>
                        ';
                }

                $output .='
                        <a href="'.route('product.details', $query->id).'" title="View Product" class="btn table-btn btn-icon btn-primary btn-sm shadow-primary mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        <a href="'.route('product.edit', $query->id).'" title="Edit Product" id="updateProduct" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.delete', $query->id).'" title="Delete Delete" id="deleteProduct" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';

                return $output;
            })->rawColumns(['action', 'is_active', 'is_hot_deal','is_featured']);
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
            Column::make('is_hot_deal')->title('Market Status'),
            Column::make('is_featured')->title('Feature Status'),
            Column::make('is_active')->title('Status'),
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
