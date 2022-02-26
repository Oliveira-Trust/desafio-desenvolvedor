<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * List profiles
     * @var $profiles
     */
    private $profiles = [
        'Administrador',
        'Investidor'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->profiles as $profile) {
            Profile::create([
                'name' => $profile
            ]);
        }
    }
}
