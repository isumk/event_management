<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Event Manager', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Collaborator', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
