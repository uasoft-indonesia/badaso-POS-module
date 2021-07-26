<?php

namespace Database\Seeders\Badaso\Content;

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
            'fill_content',
        ];

        foreach ($keys as $key) {
            // Permission::firstOrCreate([]);
        }

        Permission::generateFor('content');
    }
}
