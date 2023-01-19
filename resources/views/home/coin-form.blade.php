<div class="box box-info padding-1">
    <div class="box-body">
    <div class="form-group">
    {{Form::label('coin_dest', 'Moeda Destino:')}}
        <select name="coin_dest" class='form-control select'>
        @foreach($coins as $coin)

            <option value="{{$coin['coin_dest']}}">
            {{$coin['label']}}
            </option>
        @endforeach
        </select>
       </div> 

    </div>
    <div class="form-group">
    {{Form::label('payment_method', 'Metodo de Pagamentio:')}}
        <select name="payment_method" class='form-control form'>
        <option value="boleto">Boleto</option>
        <option value="card">Cartão</option>
        </select>
       </div>     
    </div>
    <div class="form-group">
    {{Form::label('value_of', 'Valor a ser convertido:')}}
    {{Form::text('value_of', '',['placeholder' => 'Valores acima de R$1000,00','class' => 'form-control'])}}
       </div>     
    </div>
    @guest
    <div class="form-group">
    {{Form::label('email', 'Email:')}}
    {{Form::text('email', '',['placeholder' => 'Receber por enmail','class' => 'form-control'])}}
    </div>    
       @endguest
    
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>