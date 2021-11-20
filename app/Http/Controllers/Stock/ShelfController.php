<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ShelfDataTable;
use App\Http\Controllers\Controller;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShelfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(ShelfDataTable $dataTable)
    {
        return $dataTable->render('stock.shelf.index');
    }


    public function update(Shelf $shelf, Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validation());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $shelf->update($this->dumpData($data));

        return $this->successResponse('Shelf updated successfully');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validation());

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        Shelf::query()->create($this->dumpData($data));

        return $this->successResponse('Shelf added successfully');

    }


    public function delete(Shelf $shelf)
    {
        $shelf->delete();

        return $this->successResponse('Shelf successfully deleted');
    }

    public function validation()
    {
        return [
            'name' => 'required:unique:shelf,name',
            'location' => 'required',
            'description' => 'nullable'
        ];
    }


    public function dumpData($data)
    {
        return [
            'name' => $data['name'],
            'location' => $data['location'],
            'description' => $data['description'],
        ];
    }
}
