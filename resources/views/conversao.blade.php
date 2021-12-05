@extends("app")

@section('content')

<div class="wrapper">
    <header>Conversor de moeda</header>
    <form action="#">
        <div class="amount">
            <p>Quanto deseja comprar?</p>
            <input type="number" value="1000" required>
        </div>
        <div class="drop-list">
            <div class="from">
                <p>De</p>
                <div class="select-box">
                    <img src="https://flagcdn.com/48x36/br.png" alt="flag">
                    <select>
                        <option value="BRL">BRL</option>
                    </select>
                </div>
            </div>

            <div class="icon"><i class="fas fa-arrow-right"></i></div>

            <div class="to">
                <p>Para</p>
                <div class="select-box">
                    <img src="https://flagcdn.com/48x36/us.png" alt="flag">
                    <select></select>
                </div>
            </div>
        </div>

        <div class="drop-list">
            <div class="w-100">
                <p>Qual a forma de pagamento?</p>
                <div class="select-box w-100-important">
                    <select class="typePayment">
                        <option value="BOLETO">BOLETO</option>
                        <option value="CARTAO">CARTÃO DE CRÉDITO</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="exchange-rate">&nbsp;</div>
        
        <button>Calcular</button>
    </form>
</div>

@endsection