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
    public function browse(Request $request)
    {
        try {
            $request->validate([
                'page' => 'sometimes|required|integer',
                'limit' => 'sometimes|required|integer',
                'relation' => 'nullable',
            ]);

            $data = [];

            $product_details = POSProductDetail::when($request->relation, function ($query) use ($request) {
                return $query->with(explode(',', $request->relation));
            })->paginate($request->limit)->toArray();

            $func_discounted = function ($discount, $price) {
                return $price - ($price * ($discount / 100));
            };

            $product_details['data'] = collect($product_details['data'])->map(function ($item) use ($func_discounted) {
                $item['discounted'] = 0;
                if (isset($item['discount'])) {
                    switch ($item['discount']['discount_type']) {
                        case 'percent':
                            $item['discounted'] = $func_discounted($item['discount']['discount_percent'], $item['price']);
                            break;

                        default:
                            $item['discounted'] = $item['price'] - $item['discount']['discount_fixed'];
                            break;
                    }
                }

                return $item;
            });

            $data['productDetails'] = json_decode(json_encode($product_details));

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

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
