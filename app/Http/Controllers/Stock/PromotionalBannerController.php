<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\PromotionalBannerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PromotionalBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PromotionalBannerController extends Controller
{
    public function index(PromotionalBannerDatatable $datatable)
    {
        $products = Product::query()->where('is_active', true)->orderBy('id', 'DESC')->get();

        return $datatable->render('admin.stock.banners.index', compact('products'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        DB::beginTransaction();

        try{
            if (!empty($request->file('banner'))){

                $banner = $request->file('banner');

                $data['banner'] = $this->performUpload($banner);
            }

            PromotionalBanner::query()->create($this->dumpData($data));

            DB::commit();

            return $this->successResponse('Promotional Banner uploaded successfully');
        }catch(\Exception $exception){
            Log::error("Uploading product Banner error: ".$exception->getMessage());

            DB::rollBack();

            return $this->failResponse("Promotional banner could not be uploaded. Error: ".$exception->getMessage());
        }



    }

    public function details(PromotionalBanner $banner)
    {
        return $banner;
    }

    public function edit(PromotionalBanner $banner)
    {
        return view('admin.stock.banners.edit', compact('banner'));
    }


    public function update(Request $request, PromotionalBanner $banner)
    {
        return $banner;
    }


    public function markFeatured(PromotionalBanner $banner)
    {
        return $banner;
    }

    public function delete(PromotionalBanner $banner)
    {
        return $banner;
    }

    public function validateFields($banner = null)
    {
        return [
            'name' => 'required|unique:promotional_banners,name,'.$banner,
            'description' => 'nullable',
            'banner' => 'required|mimes:jpeg,jpg,png|max:5048',
            'slider_feature' => 'nullable',
            'mark_active' => 'nullable',
            'associated_product' => 'nullable',
        ];
    }

    public function dumpData($data)
    {
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'banner' => $data['banner'],
            'is_slider_featured' => $data['slider_feature'],
            'is_active' => $data['mark_active'],
            'product_id' => $data['associated_product'],
        ];
    }


    public function performUpload($file)
    {

        $file_name = time(). '' . $file->getClientOriginalName();

        $path = "promotional_banner/";

        $abs_path = storage_path("app/public/$path");

        $file->move($abs_path, $file_name);

        return "storage/$path" . $file_name;
    }

}
