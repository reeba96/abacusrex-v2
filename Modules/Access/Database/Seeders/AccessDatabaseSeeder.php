<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AccessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
       
        $this->call("Modules\Access\Database\Seeders\RolesAndPermissionsSeeder");
        $this->call("Modules\Access\Database\Seeders\TranslateStringsSeeder");
        $this->call("Modules\Access\Database\Seeders\TranslateInvitationMailTableSeeder");
    }
}
