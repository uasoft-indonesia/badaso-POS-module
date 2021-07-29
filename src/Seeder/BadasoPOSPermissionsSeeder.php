<?php

namespace Database\Seeders\Badaso\POS;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Permission;

class BadasoPOSPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_product_categories_bin',
            'restore_product_categories',
            'delete_permanent_product_categories',
            'browse_products_bin',
            'restore_products',
            'delete_permanent_products',
            'browse_discounts_bin',
            'restore_discounts',
            'delete_permanent_discounts',
            'browse_product_details_bin',
            'restore_product_details',
            'delete_permanent_product_details',

            'browse_pos_customer_bin',
            'restore_pos_customer',
            'delete_permanent_pos_customer',
            'browse_pos_customer_bin',

            'browse_pos_employee_bin',
            'restore_pos_employee',
            'delete_permanent_pos_employee',
            'browse_pos_employee_bin',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key' => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('products', true);
        Permission::generateFor('product_details', true);
        Permission::generateFor('product_categories', true);
        Permission::generateFor('discounts', true);
        Permission::generateFor('orders', true);
        Permission::generateFor('order_details', true);

        Permission::generateFor('pos_orders', true);
        Permission::generateFor('pos_customer', true);
        Permission::generateFor('pos_employee', true);

        Permission::generateFor('payment_providers', true);
    }
}
