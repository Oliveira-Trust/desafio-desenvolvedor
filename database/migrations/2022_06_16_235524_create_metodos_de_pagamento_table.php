<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMetodosDePagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodos_de_pagamento', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_pagamento');
            $table->double('valor_taxa', 8, 5);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
        DB::insert('insert into metodos_de_pagamento (id, tipo_pagamento,valor_taxa) values (?, ?, ?)', [1, 'Boleto', '0.0145']);
        DB::insert('insert into metodos_de_pagamento (id, tipo_pagamento,valor_taxa) values (?, ?, ?)', [2, 'Cartão de crédito', '0.0763']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metodos_de_pagamento');
    }
}
