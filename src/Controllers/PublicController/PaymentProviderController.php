<?php

namespace Uasoft\Badaso\Module\POS\Controllers\PublicController;

use Exception;
use Illuminate\Http\Request;
use Uasoft\Badaso\Controllers\Controller;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Module\POS\Models\POSPaymentProvider;

class PaymentProviderController extends Controller
{
    public function browse(Request $request)
    {
        try {
            $payment_providers = POSPaymentProvider::all();

            $data['payment_providers'] = $payment_providers->toArray();

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}
