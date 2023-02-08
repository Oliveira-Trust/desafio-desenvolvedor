@extends('layouts.index')

@section('conteudo')

<!--<div class="content-wrapper">-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid animate__animated animate__fadeInUp animate__faster">
        <div class="row">
          <!-- left column -->
          
          <!--/.col (left) -->
          <!-- right column -->
          
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    {{date('d/m/Y - H:i')}} - Recibo da Negociação
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <tbody>
                    <tr>
                        <td class="col-3">Moeda de origem</td>
                        <td>{{$res['origem']}}</td>
                    </tr>
                    <tr>
                        <td>Moeda destino</td>
                        <td>{{$res['destino']}}</td>
                    </tr>
                    <tr>
                        <td>Valor para conversão</td>
                        <td>{{$res['valor_para_conversao']}}</td>
                    </tr>
                    <tr>
                        <td>Forma de pagamento</td>
                        <td>{{$res['forma_de_pagamento']}}</td>
                    </tr>
                    <tr>
                        <td>Valor da moeda de destino</td>
                        <td>{{$res['valor_moeda_destino']}}</td>
                    </tr>
                    <tr>
                        <td>Valor comprado da moeda de destino</td>
                        <td>{{$res['valor_comprado_moeda_destino']}}</td>
                    </tr>
                    <tr>
                        <td>Taxa de pagamento</td>
                        <td>{{$res['taxa_pagamento']}}</td>
                    </tr>
                    <tr>
                        <td>Taxa de conversão</td>
                        <td>{{$res['taxa_conversao']}}</td>
                    </tr>
                    <tr>
                        <td>Valor utilizado para conversão descontando as taxas</td>
                        <td>{{$res['valor_conversao_descontado_taxa']}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  <!--</div>-->

@endsection
