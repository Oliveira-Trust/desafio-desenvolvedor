<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('states')->insert([
            ['id' => 1, 'name' => 'Acre', 'slug' => 'A', 'abbr' => 'AC', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
            ['id' => 2, 'name' => 'Alagoas', 'slug' => 'alagoas', 'abbr' => 'AL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Amapá', 'slug' => 'amapa', 'abbr' => 'AP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()] ,
            ['id' => 4, 'name' => 'Amazonas', 'slug' => 'A', 'abbr' => 'AM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now( )],
            ['id' => 5, 'name' => 'Bahia', 'slug' => 'A', 'abbr' => 'BA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],    
            ['id' => 6, 'name' => 'Ceará', 'slug' => 'A', 'abbr' => 'CE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],    
            ['id' => 7, 'name' => 'Distrito Federal', 'slug' => 'A', 'abbr' => 'DF', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'name' => 'Espírito Santo', 'slug' => 'A', 'abbr' => 'ES', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'name' => 'Goiás', 'slug' => 'A', 'abbr' => 'GO', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'name' => 'Maranhão', 'slug' => 'A', 'abbr' => 'MA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'name' => 'Mato Grosso', 'slug' => 'A', 'abbr' => 'MT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'name' => 'Mato Grosso do Sul', 'slug' => 'A', 'abbr' => 'MS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'name' => 'Minas Gerais', 'slug' => 'A', 'abbr' => 'MG', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'name' => 'Pará', 'slug' => 'A', 'abbr' => 'PA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'name' => 'Paraíba', 'slug' => 'A', 'abbr' => 'PB', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'name' => 'Paraná', 'slug' => 'A', 'abbr' => 'PR', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['id' => 17, 'name' => 'Pernambuco', 'slug' => 'A', 'abbr' => 'PE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'name' => 'Piauí', 'slug' => 'A', 'abbr' => 'PI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],   
            ['id' => 19, 'name' => 'Rio de Janeiro', 'slug' => 'A', 'abbr' => 'RJ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],  
            ['id' => 20, 'name' => 'Rio Grande do Norte', 'slug' => 'A', 'abbr' => 'RN', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 21, 'name' => 'Rio Grande do Sul', 'slug' => 'A', 'abbr' => 'RS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 22, 'name' => 'Rondônia', 'slug' => 'A', 'abbr' => 'RO', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 23, 'name' => 'Roraima', 'slug' => 'A', 'abbr' => 'RR', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
            ['id' => 24, 'name' => 'Santa Catarina', 'slug' => 'A', 'abbr' => 'SC', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 25, 'name' => 'São Paulo', 'slug' => 'A', 'abbr' => 'SP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 26, 'name' => 'Sergipe', 'slug' => 'A', 'abbr' => 'SE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
            ['id' => 27, 'name' => 'Tocantins', 'slug' => 'A', 'abbr' => 'TO', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);


        foreach (State::all() as $key => $state) {
			$state->slug 		= Str::slug($state->name, '-');
			$state->created_at	= Carbon::now();
			$state->updated_at	= Carbon::now();
			$state->save();
		}
    }
}
