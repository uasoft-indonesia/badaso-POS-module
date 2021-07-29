<?php

namespace Uasoft\Badaso\Module\POS\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\POS\Models\POSDiscount;
use Uasoft\Badaso\Module\POS\Models\POSProduct;
use Uasoft\Badaso\Module\POS\Models\POSProductDetail;

class ProductDetailController extends Controller
{
    public function add(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'product_id' => 'required|exists:'.POSProduct::class.',id',
                'discount_id' => 'nullable|exists:'.POSDiscount::class.',id',
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                's_k_u' => 'nullable|string|max:255',
                'product_image' => 'required|string',
            ]);

            $product = POSProductDetail::create([
                'product_id' => $request->product_id,
                'discount_id' => $request->discount_id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'SKU' => $request->s_k_u,
                'product_image' => $request->product_image,
            ]);
            DB::commit();

            return ApiResponse::success($product);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:'.POSProduct::class.'Detail,id',
                'product_id' => 'required|exists:'.POSProduct::class.',id',
                'discount_id' => 'nullable|exists:'.POSDiscount::class.',id',
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer|min:0',
                'price' => 'required|integer|min:0',
                's_k_u' => 'nullable|string|max:255',
                'product_image' => 'required|string',
            ]);

            $product = POSProductDetail::where('id', $request->id)->update([
                'product_id' => $request->product_id,
                'discount_id' => $request->discount_id,
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'SKU' => $request->s_k_u,
                'product_image' => $request->product_image,
            ]);
            DB::commit();

            return ApiResponse::success($product);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:'.POSProduct::class.'Detail',
            ]);

            $product_details = POSProductDetail::find($request->id);
            $product_details->delete();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }
}
