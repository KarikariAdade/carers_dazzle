<?php

namespace App\DataTables;

use App\Models\PromotionalBanner;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PromotionalBannerDatatable extends DataTable
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
            ->editColumn('is_active', function ($query){
                return $query->is_active == true ? '<span class="badge badge-success shadow">Active</span>' : '<span class="badge badge-danger shadow">Inactive</span>';
            })
            ->editColumn('is_slider_featured', function ($query){
                return $query->is_slider_featured == true ? '<span class="badge badge-success shadow">Featured</span>' : '<span class="badge badge-danger shadow">Not Featured</span>';
            })
            ->editColumn('created_at', function ($query){
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->addColumn('action', function ($query){
                $output = '<div style="display: inline-flex;">';

                if ($query->is_active == false){
                    $output .= '<a href="'.route('product.banner.mark.active', [$query->id, 'active', 'not_raw']).'" id="markActive" title="Mark as Active" class="btn table-btn btn-icon btn-success btn-sm shadow-success mr-2"><i class="fa mt-2 fa-stamp"></i></a>
                        ';
                }else{
                    $output .= '<a href="'.route('product.banner.mark.active', [$query->id, 'inactive', 'not_raw']).'" id="markActive" title="Mark as Inactive" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-stamp"></i></a>
                        ';
                }

                if ($query->is_slider_featured == false){
                    $output .= '<a href="'.route('product.banner.mark.featured', [$query->id, 'mark_featured', 'not_raw']).'" id="markFeatured" title="Mark Featured" class="btn table-btn btn-icon btn-info btn-sm shadow-info mr-2"><i class="fa mt-2 fa-check-circle"></i></a>
                        ';
                }else{
                    $output .= '<a href="'.route('product.banner.mark.featured', [$query->id, 'unmark_featured', 'not_raw']).'" id="markFeatured" title="Remove Feature" class="btn table-btn btn-icon btn-dark btn-sm shadow-dark mr-2"><i class="fa mt-2 fa-times-circle"></i></a>
                        ';
                }

                $output .= '<a href="'.route('product.banner.details', $query->id).'" title="View Product" class="btn table-btn btn-icon btn-primary btn-sm shadow-primary mr-2"><i class="fa mt-2 fa-eye"></i></a>
                        <a href="'.route('product.banner.edit', $query->id).'" title="Edit Product" id="updateProduct" class="btn table-btn btn-icon btn-warning btn-sm shadow-warning mr-2"><i class="fa mt-2 fa-edit"></i></a>
                        <a href="'.route('product.banner.delete', $query->id).'" title="Delete Delete" id="deleteBanner" class="btn text-white table-btn btn-icon btn-danger btn-sm shadow-danger"><i class="fa mt-2 fa-trash"></i></a>
                        </div>';



                return $output;
            })->rawColumns(['action', 'is_active', 'is_slider_featured']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param PromotionalBanner $model
     * @return Builder
     */
    public function query(PromotionalBanner $model)
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
            Column::make('name'),
            Column::make('is_slider_featured')->title('Slider Featured'),
            Column::make('is_active')->title('Marked Active'),
            Column::make('created_at')->title('Date Created'),
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
        return 'PromotionalBanner_' . date('YmdHis');
    }
}
