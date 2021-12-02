<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('language_lines')->insert([
            'group' => 'translate',
            'key' => 'filter',
            'text' => '{"de":"Filter","en":"Filter","hu":"Szűrő"}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'translate',
            'key' => 'translated_text',
            'text' => '{"de":"Übersetzter Text","en":"Translated text","hu":"Leforditott szöveg"}',
        ]);
       

        // $this->call("OthersTableSeeder");
    }
}
