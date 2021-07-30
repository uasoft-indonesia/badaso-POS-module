<?php

namespace Uasoft\Badaso\Module\POS\Controllers;

use App\Http\Controllers\Controller;

class POSController extends Controller
{
    public function index()
    {
        return view('pos-module::layout.app');
    }
}
