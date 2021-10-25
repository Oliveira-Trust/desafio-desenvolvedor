<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::beginTransaction();
        try {
            $this->call([
                UsersTableSeeder::class,
                DominiosTableSeeder::class,
                TiposCobrancasTableseeder::class,
                CotacoesTablesSeeder::class
            ]);
            DB::commit();
        } catch(\Exception $e){
            DB::rollback();
            dd($e->getMessage());
        }
    }
}
