<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Access\Entities\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $roles = ['admin', 'operator', 'support', 'user'];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role
            ]);
        }

        // Delete the sales role if exist
        Role::where('name', 'sales')->delete();

        $admin = User::updateOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'firstname' => 'admin',
            'lastname' => '',
            'confirmed' => 1,
            'password' => Hash::make('PeopleCounter12#')
        ]);
        $admin->assignRole('admin');


        $user = User::updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'firstname' => 'test',
            'lastname' => '',
            'confirmed' => 1,
            'password' => Hash::make('test')
        ]);
        $user->assignRole('user');
    }
}
