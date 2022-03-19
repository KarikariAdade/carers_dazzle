<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\PromotionalBannerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PromotionalBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Diff\Exception;

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

        $validate = Validator::make($data, $this->validateFields('create'));

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
        return view('admin.stock.banners.detail', compact('banner'));
    }


    public function edit(PromotionalBanner $banner)
    {
        $products = Product::query()->where('is_active', true)->orderBy('id', 'DESC')->get();

        return view('admin.stock.banners.edit', compact('banner', 'products'));
    }


    public function update(Request $request, PromotionalBanner $banner)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateFields('update'));

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $data['banner'] = $banner->banner;

        if(empty($data['slider_feature'])){
            $data['slider_feature'] = $banner->is_slider_featured;
        }

        if(empty($data['slider_feature'])){
            $data['mark_active'] = $banner->is_active;
        }


        if (!empty($request->file('banner'))){

            if (File::exists($banner->banner)) {

                File::delete($banner->banner);

            }

            $banner_image = $request->file('banner');

            $data['banner'] = $this->performUpload($banner_image);
        }

        $banner->update($this->dumpData($data));

        return $this->successResponse('Promotional Banner successfully updated');
    }


    public function markFeatured(PromotionalBanner $banner, $type, $origin = null)
    {
        if ($type === 'mark_featured'){
            $banner->update([
                'is_slider_featured' => true
            ]);

            if ($origin === 'raw'){
                return back()->with('success', $banner->name.' successfully featured');
            }

            return $this->successResponse($banner->name.' successfully featured');

        }

        $banner->update([
            'is_slider_featured' => false
        ]);

        if ($origin === 'raw'){
            return back()->with('success', $banner->name.' successfully featured');
        }

        return $this->successResponse($banner->name.' successfully removed from featured');

    }


    public function markActive(PromotionalBanner $banner, $type, $origin = null)
    {
        if ($type === 'active'){
            $banner->update([
                'is_active' => true
            ]);

            if ($origin === 'raw'){
                return back()->with('success', $banner->name.' successfully marked active');
            }

            return $this->successResponse($banner->name.' successfully marked active');

        }

        $banner->update([
            'is_active' => false
        ]);

        if ($origin === 'raw'){
            return back()->with('success', $banner->name.' successfully marked inactive');
        }

        return $this->successResponse($banner->name.' successfully marked inactive');

    }


    public function delete(PromotionalBanner $banner)
    {
        DB::beginTransaction();
        try {

            if (File::exists($banner->banner)) {

                File::delete($banner->banner);

            }

            $banner->delete();

            DB::commit();

            return $this->successResponse('Promotional Banner deleted successfully');

        }catch (Exception $exception){

            DB::rollback();


            Log::alert($exception->getMessage());

            return $this->failResponse("Could not delete banner. Error: ".$exception->getMessage());
        }
    }


    public function validateFields($type)
    {
        if ($type === 'update'){

            return [
                'name' => 'required',
                'description' => 'nullable',
                'banner' => 'nullable|mimes:jpeg,jpg,png|max:5048',
                'slider_feature' => 'nullable',
                'mark_active' => 'nullable',
                'associated_product' => 'nullable',
            ];
        }


        return [

            'name' => 'required|unique:promotional_banners,name',
            'description' => 'nullable',
            'banner' => 'required|mimes:jpeg,jpg,png|max:5048',
            'slider_feature' => 'nullable',
            'mark_active' => 'nullable',
            'associated_product' => 'nullable',
        ];
    }


    public function dumpData($data)
    {

        if (empty($data['slider_feature'])){
            $data['slider_feature'] = false;
        }

        if (empty($data['mark_active'])){
            $data['mark_active'] = false;
        }
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'banner' => $data['banner'],
            'is_slider_featured' => $data['slider_feature'],
            'is_active' => $data['mark_active'],
            'product_id' => isset($data['associated_product']) ? json_encode($data['associated_product'], JSON_THROW_ON_ERROR) : null,
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
