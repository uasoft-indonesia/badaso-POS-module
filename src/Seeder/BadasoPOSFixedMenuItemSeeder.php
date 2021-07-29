<?php

namespace Database\Seeders\Badaso\POS;

use Exception;
use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Menu;
use Uasoft\Badaso\Models\MenuItem;

class BadasoPOSFixedMenuItemSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @throws Exception
     *
     * @return void
     */
    public function run()
    {
        \DB::beginTransaction();

        try {
            $menu_id = Menu::where('key', 'POS-module')->first()->id;

            $menu_items = [
                0 => [
                    'menu_id' => $menu_id,
                    'title' => 'Products',
                    'url' => '/product',
                    'target' => '_self',
                    'icon_class' => 'inventory',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 1,
                    'permissions' => 'browse_products',
                ],
                1 => [
                    'menu_id' => $menu_id,
                    'title' => 'Product Categories',
                    'url' => '/product-category',
                    'target' => '_self',
                    'icon_class' => 'category',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 2,
                    'permissions' => 'browse_product_categories',
                ],
                2 => [
                    'menu_id' => $menu_id,
                    'title' => 'Discounts',
                    'url' => '/discount',
                    'target' => '_self',
                    'icon_class' => 'local_offer',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 3,
                    'permissions' => 'browse_discounts',
                ],
                3 => [
                    'menu_id' => $menu_id,
                    'title' => 'Payment Provider',
                    'url' => '/payment-provider',
                    'target' => '_self',
                    'icon_class' => 'credit_card',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 4,
                    'permissions' => 'browse_payment_providers',
                ],
                4 => [
                    'menu_id' => $menu_id,
                    'title' => 'POS Orders',
                    'url' => '/pos-order',
                    'target' => '_self',
                    'icon_class' => 'shopping_basket',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 5,
                    'permissions' => 'browse_pos_orders',
                ],
                5 => [
                    'menu_id' => $menu_id,
                    'title' => 'Customers',
                    'url' => '/pos-customer',
                    'target' => '_self',
                    'icon_class' => 'person',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 6,
                    'permissions' => 'browse_pos_customer',
                ],
                6 => [
                    'menu_id' => $menu_id,
                    'title' => 'Employees',
                    'url' => '/pos-employee',
                    'target' => '_self',
                    'icon_class' => 'person',
                    'color' => '',
                    'parent_id' => null,
                    'order' => 7,
                    'permissions' => 'browse_pos_employee',
                ],
            ];

            $new_menu_items = [];
            foreach ($menu_items as $key => $value) {
                $menu_item = MenuItem::where('menu_id', $value['menu_id'])
                        ->where('url', $value['url'])
                        ->first();

                if (isset($menu_item)) {
                    continue;
                }

                MenuItem::create($value);
            }
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            \DB::rollBack();
        }

        \DB::commit();
    }
}
