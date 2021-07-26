<?php

namespace Database\Seeders\Badaso\Content;

use Exception;
use Illuminate\Database\Seeder;
use Uasoft\Badaso\Models\Menu;

class BadasoPOSMenusSeeder extends Seeder
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
            $new_menus = [
                'key' => 'POS-module',
                'display_name' => 'POS Menu',
            ];

            Menu::firstOrCreate($new_menus);
        } catch (Exception $e) {
            \DB::rollBack();
        }

        \DB::commit();
    }
}
