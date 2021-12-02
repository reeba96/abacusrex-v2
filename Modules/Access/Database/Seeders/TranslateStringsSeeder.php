<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TranslateStringsSeeder extends Seeder
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
            'key' => 'api_keys',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Api schlüssel","en":"Api Keys","hu":"Api kulcsok"}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'translate',
            'key' => 'countries',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Länder","en":"Countries","hu":"Országok"}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'api_logs',
            'key' => 'api_log',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Api Logs","en":"Api Logs","hu":"Api Logs"}',
        ]);
        
        DB::table('language_lines')->insert([
            'group' => 'language_line',
            'key' => 'menu',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Übersetzungen","en":"Translations","hu":"Fordítások"}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'tags',
            'key' => 'tags',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Etikett","en":"Tags","hu":"Tag-ek"}',
        ]);


       

       
    }
}
