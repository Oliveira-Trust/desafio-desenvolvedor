<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaPlanosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_planos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade')->comment('Id da empresa.');
            $table->foreignId('loja_id')->constrained('lojas')->onDelete('cascade')->comment('Id da loja.');
            $table->double('valor', 8, 2)->nullable()->comment('Valor pago.');
            $table->double('acrescimo', 8, 2)->nullable()->comment('Acrescimo de algum valor.');
            $table->double('desconto', 8, 2)->nullable()->comment('Desconto de algum valor.');
            $table->double('valor_total', 8, 2)->nullable()->comment('Valor total.');
            $table->date('data_email_vencimento')->nullable()->comment('data que enviou email de vencimento.'); 
            $table->date('data_email_reenvio_boleto')->nullable()->comment('data que reenviou email de vencimento.'); 
            $table->date('data_vencimento')->nullable()->comment('data de vencimento.'); 
            $table->date('pago_em')->nullable()->comment('data que pagou o boleto.'); 
            $table->enum('atual',['1','0'])->default('1')->comment('Seta se eh o plano atual.');
            $table->string('baixado_por',60)->nullable()->comment('Quem baixou o pagamento.');
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
        Schema::dropIfExists('empresa_planos');
    }
}
