<?php

namespace App\DataTables;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDatatable extends DataTable
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
            ->editColumn('image', function ($query) {

                if (!empty($query->image)){
                    $image = (string) $query->image;
                    $url = asset($query->image);
                    $output = '<img class="" style="width: 70px; height:70px" src="'.$url.'" alt="image">';
                    return $output;
                }
                else{
                    return 'N/A';
                }


            })

            ->editColumn('featured_category', function ($query) {

                if($query->featured_category == true){
                    return  '<span class="badge badge-success shadow">Featured</span>';

                }
                elseif ($query->featured_category == false)

                    return '<span class="badge badge-danger shadow">Not Featured</span>';


                else{
                        return 'N/A';
                    }

            })

            ->addColumn('action', function ($query){
                return '
                        <div style="display: inline-flex;">
                        <a href="'.route('product.category.update', $query->id).'" title="Edit Category" id="updateCategory" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.category.delete', $query->id).'" title="Delete Category" id="deleteCategory" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';
            })
            ->rawColumns(['image','action', 'featured_category']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param ProductCategory $model
     * @return Builder
     */
    public function query(ProductCategory $model)
    {
        return $model->newQuery();
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
            Column::make('image'),
            Column::make('name'),
            Column::make('featured_category'),
            Column::make('description'),
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
        return 'ProductCategory_' . date('YmdHis');
    }
}
