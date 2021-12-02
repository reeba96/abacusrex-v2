<?php

namespace Modules\Access\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TranslateInvitationMailTableSeeder extends Seeder
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
            'group' => 'invitation',
            'key' => 'title',
            'text' => '{"0":"de","1":"en","2":"hu","de":"title","en":"title","hu":"Meghvívás"}',
        ]);
        
        DB::table('language_lines')->insert([
            'group' => 'invitation',
            'key' => 'body',
            'text' => '{"0":"de","1":"en","2":"hu","de":"body","en":"body","hu":"Meghívás a regisztrációra. Kattintson a lenti gombra."}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'invitation',
            'key' => 'button_text',
            'text' => '{"0":"de","1":"en","2":"hu","de":"click","en":"click","hu":"Regisztrálok."}',
        ]);

        DB::table('language_lines')->insert([
            'group' => 'invitation',
            'key' => 'thanks',
            'text' => '{"0":"de","1":"en","2":"hu","de":"Danke","en":"Thanks","hu":"Köszönjük."}',
        ]);
        
        // $this->call("OthersTableSeeder");
    }
}
