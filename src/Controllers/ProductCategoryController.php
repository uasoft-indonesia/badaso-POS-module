<?php

namespace Uasoft\Badaso\Module\POS\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\POS\Models\POSProductCategory;

class ProductCategoryController extends Controller
{
    public function browse(Request $request)
    {
        try {
            $request->validate([
                'page' => 'sometimes|required|integer',
                'limit' => 'sometimes|required|integer',
            ]);

            if ($request->has(['page', 'limit'])) {
                $product_category = POSProductCategory::with('children')->paginate($request->limit);
            } else {
                $product_category = POSProductCategory::with('children')->get();
            }

            $data['product_categories'] = $product_category->toArray();

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function browseBin(Request $request)
    {
        try {
            $request->validate([
                'page' => 'sometimes|required|integer',
                'limit' => 'sometimes|required|integer',
            ]);

            if ($request->has(['page', 'limit'])) {
                $product_category = POSProductCategory::onlyTrashed()->with('children')->paginate($request->limit);
            } else {
                $product_category = POSProductCategory::onlyTrashed()->with('children')->get();
            }

            $data['product_categories'] = $product_category->toArray();

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
                'parent_id' => 'nullable|exists:'.POSProductCategory::class.',id',
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:'.POSProductCategory::class.'',
                'desc' => 'nullable|string',
                'SKU' => 'nullable|string|max:255|unique:'.POSProductCategory::class.'',
            ]);

            $product = POSProductCategory::create($request->all());
            DB::commit();

            return ApiResponse::success($product);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function restore(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:'.POSProductCategory::class,
            ]);

            $product = POSProductCategory::withTrashed()->find($request->id);
            $product->restore();
            DB::commit();

            return ApiResponse::success($product);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function restoreMultiple(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required',
            ]);

            $id_list = explode(',', $request->ids);

            DB::beginTransaction();

            foreach ($id_list as $key => $id) {
                $product_categories = POSProductCategory::withTrashed()->findOrFail($id);
                $product_categories->restore();
            }

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:'.POSProductCategory::class,
            ]);

            $product_category = POSProductCategory::with('children', 'parent')->where('id', $request->id)->first();
            $data['product_category'] = $product_category->toArray();

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:'.POSProductCategory::class.',id',
                'parent_id' => 'nullable|exists:'.POSProductCategory::class.',id',
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
                'SKU' => 'nullable|string|max:255',
            ]);

            $product_category = POSProductCategory::find($request->id);

            $product_category->parent_id = $request->parent_id ?? null;
            $product_category->name = $request->name;
            $product_category->desc = $request->desc;
            $product_category->SKU = $request->SKU;
            $product_category->update();

            DB::commit();

            return ApiResponse::success($product_category);
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
                'id' => 'required|exists:'.POSProductCategory::class,
            ]);

            $product_categories = POSProductCategory::findOrFail($request->id);
            $product_categories->delete();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function forceDelete(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'id' => 'required|exists:'.POSProductCategory::class,
            ]);

            $product = POSProductCategory::withTrashed()->find($request->id);
            $product->forceDelete();
            DB::commit();

            return ApiResponse::success($product);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMultiple(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required',
            ]);

            $id_list = explode(',', $request->ids);

            DB::beginTransaction();

            foreach ($id_list as $key => $id) {
                $product_categories = POSProductCategory::findOrFail($id);
                $product_categories->delete();
            }

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function forceDeleteMultiple(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required',
            ]);

            $id_list = explode(',', $request->ids);

            DB::beginTransaction();

            $product_categories = POSProductCategory::withTrashed()->whereIn('id', $id_list)->get();

            foreach ($product_categories as $product_category) {
                $product_category->forceDelete();
            }

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }
}
