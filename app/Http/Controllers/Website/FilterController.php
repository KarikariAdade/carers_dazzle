<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        if (request()->has('sort')){

            $sort = request()->get('sort');

            if ($sort === 'popularity'){

                return 'sort by popularity';
            }

            if ($sort === 'rating'){

                return 'sort by rating';
            }

            if ($sort === 'date'){

                return 'sort by date';
            }

        }


        return 'no sorting';
    }
}
