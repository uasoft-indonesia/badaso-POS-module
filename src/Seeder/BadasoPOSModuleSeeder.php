<?php

namespace Database\Seeders\Badaso\POS;

use Illuminate\Database\Seeder;

class BadasoPOSModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BadasoPOSPermissionsSeeder::class);
        $this->call(BadasoPOSRolePermissionsSeeder::class);
        $this->call(BadasoPOSMenusSeeder::class);
        $this->call(BadasoPOSFixedMenuItemSeeder::class);
    }
}
