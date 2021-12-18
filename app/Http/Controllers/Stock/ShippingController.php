<?php

namespace App\Http\Controllers\Stock;

use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Models\Regions;
use App\Models\Shipping;
use App\Models\Towns;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(ShippingDatatable $datatable)
    {
        $regions = Regions::query()->orderBy('name', 'ASC')->get();

        return $datatable->render('stock.shipping.index', compact('regions'));
    }


    public function store(Request $request)
    {
        return $request->all();
    }


    public function update(Request $request, Shipping $shipping)
    {
        return $shipping;
    }


    public function delete(Shipping $shipping)
    {
        return $shipping;
    }


    public function setDefault(Shipping $shipping)
    {
        return $shipping;
    }

    public function getTowns(Request $request)
    {
        $towns = Towns::query()->where('region_id', $request->get('item'))->get();

        return $towns;
    }

    public function getPageData()
    {
        return [
            'regions' => Regions::query()->orderBy('name', 'ASC')->get()
        ];
    }



}
