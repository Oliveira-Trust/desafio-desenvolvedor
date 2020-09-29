<?php

use Illuminate\Database\Seeder;

class OauthClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            [
                'id' => 1,
                'name' => ' Personal Access Client',
                'secret' => 'VUMapUL7yGM29M9gGbE1SfMTSik9wEER22YOrE73',
                'redirect' => 'http://localhost',
                'personal_access_client' => '1',
                'password_client' => '0',
                'revoked' => '0'
            ],
            [
                'id' => 2,
                'name' => ' Password Grant Client',
                'secret' => '1VUPQqxNSCVuYY00vhQ3obSTJeh5JpoAKipGwNOm',
                'redirect' => 'http://localhost',
                'personal_access_client' => '0',
                'password_client' => '1',
                'revoked' => '0'
            ],
            [
                'id' => 5,
                'name' => 'Aplicação cliente',
                'secret' => 'QD5Epk4BwkS8MzBs5Arn9J4Me2oDwQO5VA0Fxhiy',
                'redirect' => 'localhost',
                'personal_access_client' => '0',
                'password_client' => '0',
                'revoked' => '0'
            ]
        ]);
    }
}
