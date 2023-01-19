<div class="card-body">
                        
                        <div class="form-group">
                            <strong>Moeda Destino:</strong>
                            {{ $coinAsk->coin_dest }}
                        </div>
                        <div class="form-group">
                            <strong>Moeda Base:</strong>
                            {{ $coinAsk->coin_base }}
                        </div>
                        <div class="form-group">
                            <strong>Valor a ser pago:</strong>
                            {{ $coinAsk->value_of }}
                        </div>
                        <div class="form-group">
                            <strong>Methodo de Pagamento:</strong>
                            {{ $coinAsk->payment_method }}
                        </div>
                        <div class="form-group">
                            <strong>Cotação Utilizada:</strong>
                            R${{ 1/$coinAsk->ranting_ask }}
                        </div>
                        <div class="form-group">
                            <strong>Taxa de Conversão:</strong>
                            R${{ $coinAsk->tax_convert }}
                        </div>
                        <div class="form-group">
                            <strong>Taxa de  Pagamento:</strong>
                            R${{ $coinAsk->tax_payment }}
                        </div>
                        <div class="form-group">
                            <strong>Total utilizado para Conversão:</strong>
                            R${{ $coinAsk->total_used }}
                        </div>
                        <div class="form-group">
                            <strong>Total Convertido:</strong>
                            {{ $coinAsk->coin_dest }} {{ $coinAsk->total_dest }}
                        </div>
                        @isset($coinAsk->user_id)
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $coinAsk->user_id }}
                        </div>
                        @endisset   
                    </div>