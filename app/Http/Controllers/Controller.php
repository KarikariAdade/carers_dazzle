<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\ProductCategory;
use App\Models\PromotionalBanner;
use App\Models\SMSLogs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function successResponse($msg): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => 200,
            'msg' => $msg
        ]);
    }


    public function failResponse($msg): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => 401,
            'msg' => $msg
        ]);
    }


    public function logSMSData($custom_data, $data)
    {
      return SMSLogs::query()->create([
          'type' => $custom_data['type'] ?? 'N/A',
          'status' => $data['status'] ?? 'N/A',
          'message' => $custom_data['message'] ?? 'N/A',
          'recipient' => $custom_data['phone'],
      ]);
    }

    public function pageDependencies()
    {
        $categories = ProductCategory::query()->get();

        $brands = Brands::query()->get();

        $slider_featured_banners = PromotionalBanner::query()->where('is_slider_featured', true)->get();

        return [
            'categories' => $categories,
            'brands' => $brands,
            'slider_featured_banners' => $slider_featured_banners
        ];
    }

    public function generateProductRoute($id)
    {
        return route('website.shop.detail', [$this->id, strtolower(str_replace(' ', '_', $this->name)), Str::random(10)]);

    }
}
