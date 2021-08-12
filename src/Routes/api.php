<?php

use Uasoft\Badaso\Middleware\ApiRequest;
use Uasoft\Badaso\Middleware\BadasoAuthenticate;
use Uasoft\Badaso\Middleware\BadasoCheckPermissions;

$api_route_prefix = config('badaso.api_route_prefix');

Route::group(
    [
        'prefix' => $api_route_prefix,
        'namespace' => 'Uasoft\Badaso\Module\POS\Controllers',
        'as' => 'badaso.module.pos.',
        'middleware' => [ApiRequest::class],
    ],
    function () {
        Route::group(['prefix' => 'module/pos/v1'], function () {
            Route::prefix('customer')->group(function () {
                Route::get('/', 'POSCustomerController@browse')->middleware(BadasoCheckPermissions::class.':browse_pos_customer');
                Route::get('/bin', 'POSCustomerController@browseBin')->middleware(BadasoCheckPermissions::class.':browse_pos_customer_bin');
                Route::get('/read', 'POSCustomerController@read')->middleware(BadasoCheckPermissions::class.':read_pos_customer');
                Route::get('/read-slug', 'POSCustomerController@readBySlug')->middleware(BadasoCheckPermissions::class.':read_pos_customer');
                Route::post('/restore', 'POSCustomerController@restore')->middleware(BadasoCheckPermissions::class.':restore_pos_customer');
                Route::post('/restore-multiple', 'POSCustomerController@restoreMultiple')->middleware(BadasoCheckPermissions::class.':restore_pos_customer');
                Route::post('/add', 'POSCustomerController@add')->middleware(BadasoCheckPermissions::class.':add_pos_customer');
                Route::put('/edit', 'POSCustomerController@edit')->middleware(BadasoCheckPermissions::class.':edit_pos_customer');
                Route::delete('/delete', 'POSCustomerController@delete')->middleware(BadasoCheckPermissions::class.':delete_pos_customer');
                Route::delete('/delete-multiple', 'POSCustomerController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_pos_customer');
                Route::delete('/force-delete', 'POSCustomerController@forceDelete')->middleware(BadasoCheckPermissions::class.':delete_permanent_pos_customer');
                Route::delete('/force-delete-multiple', 'POSCustomerController@forceDeleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_permanent_pos_customer');
            });

            Route::prefix('employee')->group(function () {
                Route::get('/', 'POSEmployeeController@browse')->middleware(BadasoCheckPermissions::class.':browse_pos_employee');
                Route::get('/bin', 'POSEmployeeController@browseBin')->middleware(BadasoCheckPermissions::class.':browse_pos_employee_bin');
                Route::get('/read', 'POSEmployeeController@read')->middleware(BadasoCheckPermissions::class.':read_pos_employee');
                Route::get('/read-slug', 'POSEmployeeController@readBySlug')->middleware(BadasoCheckPermissions::class.':read_pos_employee');
                Route::post('/restore', 'POSEmployeeController@restore')->middleware(BadasoCheckPermissions::class.':restore_pos_employee');
                Route::post('/restore-multiple', 'POSEmployeeController@restoreMultiple')->middleware(BadasoCheckPermissions::class.':restore_pos_employee');
                Route::post('/add', 'POSEmployeeController@add')->middleware(BadasoCheckPermissions::class.':add_pos_employee');
                Route::put('/edit', 'POSEmployeeController@edit')->middleware(BadasoCheckPermissions::class.':edit_pos_employee');
                Route::delete('/delete', 'POSEmployeeController@delete')->middleware(BadasoCheckPermissions::class.':delete_pos_employee');
                Route::delete('/delete-multiple', 'POSEmployeeController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_pos_employee');
                Route::delete('/force-delete', 'POSEmployeeController@forceDelete')->middleware(BadasoCheckPermissions::class.':delete_permanent_pos_employee');
                Route::delete('/force-delete-multiple', 'POSEmployeeController@forceDeleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_permanent_pos_employee');
            });

            Route::group(['prefix' => 'product'], function () {
                Route::get('/', 'ProductController@browse')->middleware(BadasoCheckPermissions::class.':browse_products');
                Route::get('/bin', 'ProductController@browseBin')->middleware(BadasoCheckPermissions::class.':browse_products_bin');
                Route::get('/read', 'ProductController@read')->middleware(BadasoCheckPermissions::class.':read_products');
                Route::get('/read-slug', 'ProductController@readBySlug')->middleware(BadasoCheckPermissions::class.':read_products');
                Route::post('/restore', 'ProductController@restore')->middleware(BadasoCheckPermissions::class.':restore_products');
                Route::post('/restore-multiple', 'ProductController@restoreMultiple')->middleware(BadasoCheckPermissions::class.':restore_products');
                Route::post('/add', 'ProductController@add')->middleware(BadasoCheckPermissions::class.':add_products');
                Route::put('/edit', 'ProductController@edit')->middleware(BadasoCheckPermissions::class.':edit_products');
                Route::delete('/delete', 'ProductController@delete')->middleware(BadasoCheckPermissions::class.':delete_products');
                Route::delete('/delete-multiple', 'ProductController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_products');
                Route::delete('/force-delete', 'ProductController@forceDelete')->middleware(BadasoCheckPermissions::class.':delete_permanent_products');
                Route::delete('/force-delete-multiple', 'ProductController@forceDeleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_permanent_products');
            });

            Route::group(['prefix' => 'product-detail'], function () {
                Route::get('/', 'ProductDetailController@browse')->middleware(BadasoCheckPermissions::class.':browse_product_details');
                Route::post('/add', 'ProductDetailController@add')->middleware(BadasoCheckPermissions::class.':add_product_details');
                Route::put('/edit', 'ProductDetailController@edit')->middleware(BadasoCheckPermissions::class.':edit_product_details');
                Route::delete('/delete', 'ProductDetailController@delete')->middleware(BadasoCheckPermissions::class.':delete_product_details');
            });

            Route::group(['prefix' => 'product-category'], function () {
                Route::get('/', 'ProductCategoryController@browse')->middleware(BadasoCheckPermissions::class.':browse_product_categories');
                Route::get('/bin', 'ProductCategoryController@browseBin')->middleware(BadasoCheckPermissions::class.':browse_product_categories_bin');
                Route::get('/read', 'ProductCategoryController@read')->middleware(BadasoCheckPermissions::class.':read_product_categories');
                Route::get('/read-slug', 'ProductCategoryController@readBySlug')->middleware(BadasoCheckPermissions::class.':read_product_categories');
                Route::post('/restore', 'ProductCategoryController@restore')->middleware(BadasoCheckPermissions::class.':restore_product_categories');
                Route::post('/restore-multiple', 'ProductCategoryController@restoreMultiple')->middleware(BadasoCheckPermissions::class.':restore_product_categories');
                Route::post('/add', 'ProductCategoryController@add')->middleware(BadasoCheckPermissions::class.':add_product_categories');
                Route::put('/edit', 'ProductCategoryController@edit')->middleware(BadasoCheckPermissions::class.':edit_product_categories');
                Route::delete('/delete', 'ProductCategoryController@delete')->middleware(BadasoCheckPermissions::class.':delete_product_categories');
                Route::delete('/delete-multiple', 'ProductCategoryController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_product_categories');
                Route::delete('/force-delete', 'ProductCategoryController@forceDelete')->middleware(BadasoCheckPermissions::class.':delete_permanent_product_categories');
                Route::delete('/force-delete-multiple', 'ProductCategoryController@forceDeleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_permanent_product_categories');
            });

            Route::group(['prefix' => 'discount'], function () {
                Route::get('/', 'DiscountController@browse')->middleware(BadasoCheckPermissions::class.':browse_discounts');
                Route::get('/bin', 'DiscountController@browseBin')->middleware(BadasoCheckPermissions::class.':browse_discounts_bin');
                Route::get('/read', 'DiscountController@read')->middleware(BadasoCheckPermissions::class.':read_discounts');
                Route::post('/restore', 'DiscountController@restore')->middleware(BadasoCheckPermissions::class.':restore_discounts');
                Route::post('/restore-multiple', 'DiscountController@restoreMultiple')->middleware(BadasoCheckPermissions::class.':restore_discounts');
                Route::post('/add', 'DiscountController@add')->middleware(BadasoCheckPermissions::class.':add_discounts');
                Route::put('/edit', 'DiscountController@edit')->middleware(BadasoCheckPermissions::class.':edit_discounts');
                Route::delete('/delete', 'DiscountController@delete')->middleware(BadasoCheckPermissions::class.':delete_discounts');
                Route::delete('/delete-multiple', 'DiscountController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_discounts');
                Route::delete('/force-delete', 'DiscountController@forceDelete')->middleware(BadasoCheckPermissions::class.':delete_permanent_discounts');
                Route::delete('/force-delete-multiple', 'DiscountController@forceDeleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_permanent_discounts');
            });

            Route::group(['prefix' => 'provider'], function () {
                Route::get('/', 'PaymentProviderController@browse')->middleware(BadasoCheckPermissions::class.':browse_payment_providers');
                Route::get('/read', 'PaymentProviderController@read')->middleware(BadasoCheckPermissions::class.':read_payment_providers');
                Route::post('/add', 'PaymentProviderController@add')->middleware(BadasoCheckPermissions::class.':add_payment_providers');
                Route::put('/edit', 'PaymentProviderController@edit')->middleware(BadasoCheckPermissions::class.':edit_payment_providers');
                Route::delete('/delete', 'PaymentProviderController@delete')->middleware(BadasoCheckPermissions::class.':delete_payment_providers');
                Route::delete('/delete-multiple', 'PaymentProviderController@deleteMultiple')->middleware(BadasoCheckPermissions::class.':delete_payment_providers');
            });

            Route::group(['prefix' => 'product/public'], function () {
                Route::get('/', 'PublicController\ProductController@browse');
                Route::get('/read', 'PublicController\ProductController@read');
            });

            Route::group(['prefix' => 'product-category/public'], function () {
                Route::get('/', 'PublicController\ProductCategoryController@browse');
                Route::get('/read', 'PublicController\ProductCategoryController@read');
            });

            Route::group(['prefix' => 'provider-2/public', 'middleware' => [BadasoAuthenticate::class]], function () {
                Route::get('/', 'PublicController\PaymentProviderController@browse');
            });
        });
    }
);
