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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use AmrShawky\LaravelCurrency\Facade\Currency;

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


    public function sendSMS($data)
    {
        $msg = $data['msg'];
        $fields = [
            'sender' => env('FAYASMS_SENDER'),
            'message' => $msg,
            'recipients' => [
                $data['phone']
            ]
        ];

        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = 'fayasms-developer: 17596282.BD8nlMwlSlVUkXBvAa6uzLatjqBSDJpu';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, env('FAYASMS_URL'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);

        Log::info($result);

        $data['type'] = "Susu SMS";


        $this->logSMSData($data,$result);

    }


    public function convertCurrency($selected)
    {
        if ($selected === 'GHS'){
            session()->put('from_currency', 'GHS');

            session()->put('to_currency', 'GHS');

            session()->put('sign', 'GHS');
        }else{

            session()->put('from_currency', 'GHS');

            session()->put('to_currency', 'USD');

            session()->put('sign', '$');
        }

        return back();
    }



}
