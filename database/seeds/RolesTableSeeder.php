<?php

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Role::create(['name' => 'worker']);
    Role::create(['name' => 'user']);
    Role::create(['name' => 'spectateur']);
    }
}
