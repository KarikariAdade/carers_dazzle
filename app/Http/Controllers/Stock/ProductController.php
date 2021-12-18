<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPicture;
use App\Models\SubCategory;
use App\Models\Taxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ProductDatatable $datatable)
    {
        $items = $this->pageItems();

        return $datatable->render('stock.products.index', compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $product = Product::query()->create($this->dump($data));

        if (!empty($request->file('image'))){

            $images = collect();

            foreach ($request->file('image') as $image){
                $images->push([
                    'product_id' => $product->id,
                    'path' => $this->performUpload($image)
                ]);
            }

            DB::table('product_pictures')->insert($images->toArray());

        }


        return $this->successResponse("Product: $product->name added successfully");

    }


    public function edit(Product $product)
    {
        $items = $this->pageItems();

        return view('stock.products.edit', compact('product', 'items'));
    }


    public function details(Product $product)
    {
        $taxes = [];

        if (!empty($product->taxes)){
            $taxes = Taxes::query()->whereIn('id', json_decode($product->taxes))->get();
        }

        return view('stock.products.show', compact('product', 'taxes'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();


        $validate = Validator::make($data, $this->validateData($product->id));

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if (!empty($request->file('image'))) {

            $images = collect();

            foreach ($request->file('image') as $image) {
                $images->push([
                    'product_id' => $product->id,
                    'path' => $this->performUpload($image),
                    'created_at' => now()
                ]);
            }

            DB::table('product_pictures')->insert($images->toArray());
        }


        $product->update($this->dump($data));

        return $this->successResponse("Product: $product->name updated successfully");
    }


    public function delete(Product $product)
    {
        DB::transaction(function () use ($product){
            $images = ProductPicture::query()->where('product_id', $product->id)->get();


            foreach($images as $image){

                if (File::exists($image->path)){

                    File::delete($image->path);

                    Log::info('File deleted');
                }
            }

            DB::table('product_pictures')->where('product_id', $product->id)->delete();

            $product->delete();
        });

        return $this->successResponse('Product deleted successfully');

    }


    public function deleteProductPicture(ProductPicture $picture)
    {
        if (File::exists($picture->path)){
            File::delete($picture->path);
        }

        $picture->delete();

        return back()->withInput()->with('success', 'Image deleted successfully');
    }

    public function dump($data)
    {

        return [
            'name' => $data['name'],
            'category_id' => $data['category'],
            'brand_id' => $data['brand'],
            'price' => $data['price'],
            'shelf_id' => $data['sub_category'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
            'taxes' => json_encode($data['taxes'], JSON_THROW_ON_ERROR | true),
            'is_active' => $data['status']
        ];
    }


    public function validateData($product = null)
    {

        return [
            'name' => 'required|unique:taxes,name,'.$product,
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'product' => 'nullable|mimes:jpeg,jpg,png|max:5048',
            'sub_category' => 'required',
            'description' => 'nullable',
            'quantity' => 'required',
            'taxes' => 'nullable',
            'is_active' => 'nullable',
        ];
    }


    public function performUpload($file)
    {

        # Add random string to filename
        $file_name = time(). '' . $file->getClientOriginalName();

        # Set file path

        $path = "product_image/";

        # Get absolute path for file storage
        $abs_path = storage_path("app/public/$path");

//        Storage::put($abs_path, $file_name);
        $file->move($abs_path, $file_name);

        return "storage/$path" . $file_name;
    }


    public function pageItems()
    {
        return [
            'categories' => ProductCategory::query()->get(),
            'sub_categories' => SubCategory::query()->get(),
            'brands' => Brands::query()->get(),
            'taxes' => Taxes::query()->get(),
        ];

    }


}
