<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_admin_id')->nullable()->constrained('empresas')->comment('Id da empresa admin.');
            $table->enum('tipo_pessoa',['PJ','PF'])->default('PJ')->comment('Seta se pessoa fisica ou juridica.');
            $table->string('razao_social',100)->comment('Razão social.'); 
            $table->string('nome_fantasia',100)->nullable()->comment('Nome fantasia.'); 
            $table->string('cpf_cnpj',18)->nullable()->comment('CPF ou CNPJ.'); 
            $table->string('cep',15)->nullable()->comment('cep da empresa.'); 
            $table->string('logradouro',100)->nullable()->comment('logradouro da empresa.'); 
            $table->string('numero',20)->nullable()->comment('numero da empresa.'); 
            $table->string('complemento',50)->nullable()->comment('complemento da empresa.'); 
            $table->string('bairro',100)->nullable()->comment('bairro da empresa.'); 
            $table->string('nome_cidade',100)->nullable()->comment('nome_cidade da empresa.'); 
            $table->string('codigo_cidade',100)->nullable()->comment('codigo_cidade da empresa.'); 
            $table->string('estado',2)->nullable()->comment('estado da empresa.'); 
            $table->string('codigo_siafi',2)->nullable()->comment(' codigo estado da empresa.'); 
            $table->string('email',100)->nullable()->comment('email.'); 
            $table->string('telefone',15)->nullable()->comment('telefone.'); 
            $table->string('celular',15)->nullable()->comment('celular.'); 
            $table->date('ativou_em')->nullable()->comment('data que foi ativado o plano.'); 
            $table->enum('tipo',['A','T','C'])->default('T')->comment('A - Admin, T -  Tipster, C -Cliente do tipster.'); 
            $table->enum('ativo',['S','N'])->default('S')->comment('Seta se esta ativo ou não.'); 
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
        Schema::dropIfExists('empresas');
    }
}
