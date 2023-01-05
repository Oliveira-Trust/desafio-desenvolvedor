@extends('layouts.master')

@section('h1', 'Painel Administrativo')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Formulário - Formas de Pagamento</h3>
                </div>

                <form action="{{ route('admin.pagamento') }}" method="POST" class="form-admin">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="taxa">Taxa</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="taxa" step=".01" name="taxa">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formas de Pagamento</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Forma de Pagamento</th>
                            <th>Taxa</th>
                            <th style="width: 10px">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pagamentos as $pagamento)
                                <tr>
                                    <td>{{ $pagamento->nome }}</td>
                                    <td>{{ $pagamento->taxa * 100 }} %</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Formulário - Taxa por Valor</h3>
                </div>

                <form action="{{ route('admin.taxa') }}" method="POST" class="form-admin">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome">Valor (R$)</label>
                            <input type="text" class="form-control money" id="nome" name="valor">
                        </div>
                        <div class="form-group">
                            <label for="taxa">Taxa</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="taxa" name="taxa" step="0.1">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Taxas</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Valor</th>
                            <th>Taxa</th>
                            <th style="width: 10px">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($taxas as $taxa)
                            <tr>
                                <td>R$ {{ number_format($taxa->valor, 2, ',', '.') }}</td>
                                <td>{{ $taxa->taxa * 100 }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $('.form-admin').on('submit', function (e) {
                e.preventDefault();

                let endpoint = $(this).attr('action'),
                    method   = $(this).attr('method'),
                    data     = $(this).serialize()

                $.ajax({
                    url: endpoint,
                    type: method,
                    data: data,
                    success: function (xhr) {
                        if (xhr.success === false) {
                            toastr.error('<li>'+ xhr.message +'</li>');
                        }

                        if (xhr.action === 'redirect') {
                            window.location.reload();
                        }
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors,
                        errorsHtml = '';

                        $.each(errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });

                        toastr.error( errorsHtml);
                    }
                });
            });
        });
    </script>
@endsection

