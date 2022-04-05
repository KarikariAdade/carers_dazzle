<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['loadReviews']);
    }


    public function addReview(Product $product, Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'title' => 'required',
            'description' => 'required|max:300',
            'rating' => 'required'
        ]);

        if ($validate->fails()){
            return $this->failResponse($validate->errors()->first());
        }

        $data['product_id'] = $product->id;

        DB::beginTransaction();

        try {

            $product->rateOnce($data['rating']);

            $check_review = Review::query()->where('user_id', auth()->guard('web')->user()->id)
                ->where('product_id', $data['product_id'])->first();


            if (!empty($check_review)){

                $check_review->update($this->dumpRating($data));

            }else{

                Review::query()->create($this->dumpRating($data));

            }

            DB::commit();

            session()->flash('success', 'Your review has been submitted successfully');

            return $this->successResponse('Your review has been submitted successfully');

        } catch (\Exception $exception){

            DB::rollBack();

            return $this->failResponse('Review could not be added. Kindly try again after some time');

        }

    }


    public function loadReviews()
    {

    }

    public function dumpRating($data)
    {
        return [
            'title' => $data['title'],
            'product_id' => $data['product_id'],
            'rating' => $data['rating'],
            'description' => $data['description'],
            'user_id' => auth()->guard('web')->user()->id,
        ];
    }
}
