<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lojas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade')->comment('Id da empresa.');
            $table->string('nome',60)->comment('Nome da Loja.');
            $table->enum('matriz',['1','0'])->default('0')->comment('Identifica se é matriz ou filial.'); 
            $table->enum('tipo_pessoa',['PJ','PF'])->default('PJ')->comment('Seta se pessoa fisica ou juridica.');
            $table->string('razao_social',100)->comment('Razão social.'); 
            $table->string('nome_fantasia',100)->comment('Nome fantasia.'); 
            $table->string('cpf_cnpj',18)->nullable()->comment('CPF ou CNPJ.'); 
            $table->string('inscricao_estadual',18)->nullable()->comment('Inscrição estadual.'); 
            $table->enum('isenta_ins_est',['1','0'])->default('0')->comment('Identifica se insento de inscricao estadual.'); 
            $table->string('inscricao_municipal',18)->nullable()->comment('Inscrição municipal.'); 
            $table->string('email',100)->nullable()->comment('email.'); 
            $table->string('telefone',15)->nullable()->comment('telefone.'); 
            $table->string('celular',15)->nullable()->comment('celular.');
            $table->string('cep',15)->nullable()->comment('cep da loja.'); 
            $table->string('logradouro',100)->nullable()->comment('logradouro da loja.'); 
            $table->string('numero',20)->nullable()->comment('numero da loja.'); 
            $table->string('complemento',50)->nullable()->comment('complemento da loja.'); 
            $table->string('bairro',100)->nullable()->comment('bairro da loja.'); 
            $table->string('nome_cidade',100)->nullable()->comment('nome_cidade da loja.'); 
            $table->string('codigo_cidade',100)->nullable()->comment('codigo_cidade da loja.'); 
            $table->string('estado',2)->nullable()->comment('estado da loja.'); 
            $table->string('timezone',30)->default('America/Sao_Paulo')->comment('Time zone da loja.'); 
            $table->enum('ativo',['S','N'])->default('S')->comment('Seta se esta ativo ou não.'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Id do usuario.');
            $table->string('nome_usuario',60)->nullable()->comment('Nome do usuario.');
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
        Schema::dropIfExists('lojas');
    }
}
