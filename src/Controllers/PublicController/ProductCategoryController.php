<?php

namespace Uasoft\Badaso\Module\POS\Controllers\PublicController;

use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\POS\Models\POSProductCategory;

class ProductCategoryController extends Controller
{
    public function browse(Request $request)
    {
        try {
            $categories = POSProductCategory::with('children')->get();
            $data['product_categories'] = $categories->toArray();

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {
        try {
            $request->validate([
                'slug' => 'required|exists:'.POSProductCategory::class.'',
            ]);

            $categories = POSProductCategory::with(['children'])->where('slug', $request->slug)->first();
            $data['product_categories'] = $categories->toArray();

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}
