<?php

namespace Uasoft\Badaso\Module\POS\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\POS\Models\POSPaymentProvider;

class PaymentProviderController extends Controller
{
    public function browse(Request $request)
    {
        try {
            $request->validate([
                'page' => 'sometimes|required|integer',
                'limit' => 'sometimes|required|integer',
            ]);

            if ($request->has(['page', 'limit'])) {
                $payment_providers = POSPaymentProvider::paginate($request->limit);
            } else {
                $payment_providers = POSPaymentProvider::all();
            }

            $data['payment_providers'] = $payment_providers->toArray();

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
                'name' => 'required|string|max:255',
            ]);

            $payment_provider = POSPaymentProvider::create($request->all());
            DB::commit();

            return ApiResponse::success($payment_provider);
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:'.POSPaymentProvider::class.',id',
            ]);

            $payment_provider = POSPaymentProvider::where('id', $request->id)->first();
            $data['payment_provider'] = $payment_provider->toArray();

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
                'id' => 'required|exists:'.POSPaymentProvider::class.',id',
                'name' => 'required|string|max:255',
            ]);

            $payment_provider = POSPaymentProvider::find($request->id);
            $payment_provider->name = $request->name;
            $payment_provider->update();

            DB::commit();

            return ApiResponse::success($payment_provider);
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
                'id' => 'required|exists:'.POSPaymentProvider::class.',id',
            ]);

            $payment_provider = POSPaymentProvider::find($request->id);
            $payment_provider->delete();

            DB::commit();

            return ApiResponse::success();
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
                $payment_provider = POSPaymentProvider::findOrFail($id);
                $payment_provider->delete();
            }

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollback();

            return ApiResponse::failed($e);
        }
    }
}
