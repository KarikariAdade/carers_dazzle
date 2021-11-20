<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ProductDatatable;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

        $validate = Validator::make($data, $this->validateData($data));

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if (!empty($request->file('image'))){

            $data['image'] = $this->performUpload($request->file('image'));

        }
        $product = Product::query()->create($this->dump($data));

        return $this->successResponse("Product: $product->name added successfully");

    }


    public function edit(Product $product)
    {
        $items = $this->pageItems();

        return view('stock.products.edit', compact('product', 'items'));
    }


    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData($data));

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        if (!empty($request->file('image'))){

            if (File::exists($product->product_image)) {
                File::delete($product->product_image);
            }

            $data['image'] = $this->performUpload($request->file('image'));


            $product->update($this->dump($data));
        }else{

            $data['image'] = $product->product_image;

            $product->update($this->dump($data));
        }

        return $this->successResponse("Product: $product->name updated successfully");
    }

    public function dump($data)
    {

        return [
            'name' => $data['name'],
            'category_id' => $data['category'],
            'brand_id' => $data['brand'],
            'price' => $data['price'],
            'product_image' => $data['image'] ?? null,
            'shelf_id' => $data['shelf'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
        ];
    }


    public function validateData()
    {

        return [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'price' => 'required',
            'product' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'shelf' => 'required',
            'description' => 'nullable',
            'quantity' => 'required',
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
            'shelves' => Shelf::query()->get(),
            'brands' => Brands::query()->get(),
        ];

    }
}
