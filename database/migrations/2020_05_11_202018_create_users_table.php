<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade')->comment('Id da empresa.');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf',18)->nullable()->comment('CPF'); 
            $table->double('valor_unidade_bet_365', 10, 2)->default(0)->comment('valor da unidade do bet365 do cliente.');
            $table->string('username')->nullable();
            $table->timestamp('email_verificado_em')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('password');
            $table->enum('tipo',['A','T','C'])->default('T')->comment('A - Admin, T -  Tipster, C -Cliente do tipster.'); 
            $table->enum('ativo',['S','N'])->default('S')->comment('Seta se esta ativo ou não.'); 
            $table->string('foto',200)->nullable()->comment('Foto ');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
