<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <script src='https://code.jquery.com/jquery-2.2.4.js'></script>
        <script src='https://cdn.socket.io/socket.io-2.0.3.js'></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

        <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-bulma@4/bulma.css" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

        <title>Oliveira</title>
        <style>
            body {
            padding: 0;
            margin: 0;
            height: 100vh;
            background: -webkit-linear-gradient(#fff 0%, #f2f7ff 100%);
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            }
            .active-back {
            color: #919cb2 !important;
            }
            .active-back:hover {
            cursor: pointer;
            color: #286efa !important;
            }
            .back {
            position: absolute;
            height: 20px;
            width: 40px;
            color: #d6dae4;
            display: block;
            transition: 0.3s;
            margin-left: 20px;
            margin-top: -30px;
            font-size: 24px;
            }
            .shift {
            left: -330px !important;
            }
            h3 {
            position: absolute;
            margin-left: 38px;
            margin-top: 80px;
            font-size: 22px;
            font-weight: 200;
            color: #4f5c76;
            
            }
            input {
            width: 250px;
            height: 35px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 14px;
            padding-left: 10px;
            transition: 0.3s;
            }
            input::-webkit-input-placeholder {
            font-size: 14px;
            }
            input:focus {
            border: 1px solid #286efa !important;
            outline-width: 0;
            }
            button {
            width: 100%;
            height: 40px;
            background: #286efa;
            color: #fff;
            font-size: 14px;
            border: 1px solid #286efa;
            border-radius: 3px;
            }
            button:hover {
            background: #3c82ff;
            cursor: pointer;
            }
            .form {
            position: relative;
            margin: 0 auto;
            margin-top: 100px;
            width: 400px;
            height: 475px;
            background: #fff;
            box-shadow: 0px 5px 80px 0px #e4e8f0;
            border-radius: 5px;
            overflow: hidden;
            }
            .form form {
            width: 300px;
            }
            .form form .inputs {
            position: relative;
            left: 65px;
            top: 150px;
            transition: 0.3s;
            }
            .form form .inputs .amount {
            float: left;
            position: relative;
            width: 350px;
            }

            .warning {
            color: #f00;
            text-align: center;
            font-size: 15px;
            margin-top: 30px;
            }
            .loader {
            margin-left: 22%;
            margin-top: 22%;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 5px solid #e8ebf1;
            border-top-color: #286efa;
            animation: spinner 1s infinite linear;
            }
            .form-area {
                background-color: #fff;
                box-shadow: 0px 4px 8px rgb(0 0 0 / 16%);
                padding: 40px;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .form-area .form-inner {
                width: 100%;
            }
            .form-group{
                position: relative;
                margin-bottom: 30px;
            }
            .form-control {
                display: block;
                width: 100%;
                height: auto;
                padding: 8px 19px;
                padding-top: 21px;
                min-height: 55px;
                font-size: 1rem;
                color: #475F7B;
                background-color: #FFF;
                border: 1px solid #DFE3E7;
                border-radius: .267rem;
                -webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            }
            select.form-control{
                padding-top: 10px;
                transition: 0.15s;
            }
            .form-control:focus {
                color: #475F7B;
                background-color: #FFF;
                border-color: #5A8DEE;
                outline: 0;
                box-shadow: none;
            }
            .floating-label {
                font-size: 16px;
                font-weight: 400;
                color: #475F7B;
                opacity: 1;
                top: 16px;
                left: 20px;
                pointer-events: none;
                position: absolute;
                transition: 240ms;
                margin-bottom: 0;
                z-index: 1;
            }
            .floating-diff .floating-label{
                opacity: 0;
            }
            .floating-diff.focused .floating-label{
                opacity: 1;
            }
            .form-group.focused .floating-label {
                opacity: 1;
                color: #7b7f82;
                top: 4px;
                left: 19px;
                font-size: 12px;
            }
            @-moz-keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
            }
            @-webkit-keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
            }
            @-o-keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
            }
            @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
            }
            /*--------select2-css----*/
.select2Part .floating-label{
    opacity: 0;
}
.select2Part.focused .floating-label{
    opacity: 1;
}
.select2multiple .floating-label{
    opacity: 1;
}
.select2Part.focused .select2-container--default .select2-selection--single .select2-selection__rendered{
    padding-top: 13px;
}
.select2-container--default .select2-selection--single{
    border: 1px solid #DFE3E7;
    height: 55px;
}
.select2-container--focus.select2-container--default .select2-selection--single{
    border: 1px solid #5A8DEE;
    background-color: #fff;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    line-height: 40px;
    transition: 240ms;
    padding-right: 40px;
    font-size: 16px;
    font-weight: 400;
    color: #475F7B;
    padding-top: 7px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 53px;
    right: 15px;
    transition: 240ms;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: rgb(236 238 241);
    color: #4a494a;
}
.select2-container--default .select2-selection--single .select2-selection__arrow b{
    border: none;
    background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00NzMgMjc3IDEyIDgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQ3MyAyNzcgMTIgODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzhBOTNBNjt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTS00NzEuNiwyNzcuM2w0LjYsNC42bDQuNi00LjZsMS40LDEuNGwtNiw2bC02LTZMLTQ3MS42LDI3Ny4zeiIvPg0KPC9zdmc+DQo=') no-repeat 0 0;
    width: 12px;
    height: 8px;
    background-size: 100% 100%;
    transform: translateY(-50%);
    left: 0;
    right: 0;
    margin: auto;
}
.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #5A8DEE;
    color: #fff;
}  
.select2-container--default .select2-results__option:last-child{
    border-radius: 0px 0px 4px 4px;
}
.select2-container--default .select2-selection--single{
    border-radius: .267rem;
}
.select2-container .select2-selection--single .select2-selection__rendered{
    padding-left: 19px;

}
.select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple, 
.select2-container--default.select2-container--open.select2-container--above .select2-selection--single {
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}
.select2-results__option {
    padding: 8px 18px;
    user-select: none;
    -webkit-user-select: none;
    color: #4F4F4F;
    font-size: 15px;
    font-weight: 400;
}
.select2-container--open .select2-dropdown--above {
    box-shadow: 0px 6px 32px rgb(0 0 0 / 10%);
    border-radius: 0px;
    border: none;
    top: 8px;
    border-radius: 6px;
    overflow: hidden;
}

.select2-container--open .select2-dropdown--below{
    box-shadow: 0px 2px 18px rgb(0 0 0 / 16%);
    border-radius: 0px;
    border: none;
    top: -8px;
    border-radius: 6px;
    overflow: hidden;
}
.select2Part.w-100 > .select2-container{    
    width: 100% !important;
}
.select2-search--dropdown{
    padding: 12px 15px;
    position: relative;
}
.select2-container--default .select2-search--dropdown .select2-search__field{
    font-size: 14px;
    border: 1px solid #DFE3E7;
    border-radius: 4px;
    color: #757575;
    padding: 10px 15px;
    background-color: #fff;
    position: relative;
    padding-right: 45px;
}
.select2-container--default .select2-search--dropdown:after{
    content: "\f002";
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    top: 23px;
    right: 30px;
    font-size: 15px;
    color: rgba(0,0,0,0.54);
}
.select2-container--default .select2-selection--multiple{
    background-color: #fff;
    border: 1px solid #DFE3E7;
    min-height: 50px;
    border-radius: 6px;
    position: relative;
}
.select2-container--default.select2-container--focus .select2-selection--multiple{
    border: 1px solid #5A8DEE;
    background-color: #fff;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered{
    color: #757575;
    line-height: 55px;
    padding-right: 40px;
    display: block;
    height: 100%;
    padding-bottom: 7px;
    padding-top: 17px;
    padding-left: 17px;
    transition: 240ms;
}
.select2-container--default .select2-selection--multiple .select2-selection__arrow {
    height: 48px;
    right: 15px;
}
.select2-container--default .select2-selection--multiple .select2-search--inline .select2-search__field{
    line-height: initial;
    padding: 0;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered:before {
    border: none;
    content: '';
    background: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00NzMgMjc3IDEyIDgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQ3MyAyNzcgMTIgODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzhBOTNBNjt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTS00NzEuNiwyNzcuM2w0LjYsNC42bDQuNi00LjZsMS40LDEuNGwtNiw2bC02LTZMLTQ3MS42LDI3Ny4zeiIvPg0KPC9zdmc+DQo=') no-repeat 0 0;
    width: 12px;
    height: 8px;
    background-size: 100% 100%;
    transform: translateY(-50%);
    position: absolute;
    right: 18px;
    top: 26px;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    line-height: initial;
    padding: 5px;
    font-size: 14px;
    position: relative;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f1f1f1;
    border: 1px solid #f1f1f1;
    border-radius: 4px;
    cursor: default;
    float: left;
    color: #1f1f1f;
    margin-right: 5px;
    margin-top: 5px;
    width: initial !important;
    padding: 5px 10px;
    padding-right: 24px !important;
    font-size: 13px !important;
    letter-spacing: 0.3px;
}
.select2-container--default .select2-search--inline .select2-search__field{
    width: 100% !important;
    font-size: 16px;
    margin-top: 0px;
    padding: 0;
    padding-left: 5px;
    line-height: 27px;
    padding-top: 6px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    position: absolute;
    font-size: 17px;
    width: 20px;
    height: 20px;
    top: 3px;
    text-align: center;
    color: #e45555;
    right: 0px;
}
.floating-group.focused .select2-container--default .select2-selection--multiple .select2-selection__rendered{
    padding-bottom: 7px;
    padding-top: 17px;
    padding-left: 17px;
}
        </style>
    </head>
    <body>
        <div class="form">
        <div class="row justify-content-center">
			<div class="col-md-6 mt-5 mb-5">
				<div class="form-area">
					<div class="form-inner">
						<form action="javascript:void(0);">
                            <div class="form-group select2Part w-100 floating-group">
                                <label class="floating-label">Source Currency</label>
                                <select name="source" class="source form-control customSelect floating-control">
                                    <option selected value="BRL">BRL - Real Brasileiro</option>
                                    <option value="USD">USD - Dólar Americano</option>
                                    <option value="EUR">EUR - Euro</option>
                                </select>
                            </div>
							<div class="form-group select2Part w-100 floating-group">
                                <label class="floating-label">Select State</label>
                                <select name="target" class="target form-control customSelect floating-control">
                                    @foreach($types as $code => $type)
                                    <option value="{{ $code }}">{{$code}} - {{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group select2Part w-100 floating-group">
                                <label class="floating-label">Payment method</label>
                                <select name="method" class="method form-control customSelect floating-control">
                                    <option selected value="billet">Billet</option>
                                    <option value="credit-card">Creditcard</option>
                                </select>
                            </div>
							<div class="form-group floating-group">
								<label class="floating-label">Amount</label>
                                <input name="amount" type="number" step="0.01" class="amount form-control floating-control" placeholder="3000.00" min="1000" max="100000">
							</div>
							<button type="submit" class="btn btn-primary form-submit quotation">Quotation</button>
						</form>
					</div>
				</div>
			</div>
		</div>
            <div class='last'></div>

                <li>Moeda de origem:  source_currency </li>
                <li>Moeda de destino:  target_currency </li>
                <li>Valor para conversão:  source_prefix source_amount </li>
                <li>Forma de pagamento:  method </li>
                <li>Valor da "Moeda de destino" usado para conversão:  target_prefix target_value </li>
                <li>Valor comprado em "Moeda de destino":  target_prefix target_total </li>
                <li>Taxa de pagamento:  source_prefix payment_tax </li>
                <li>Taxa de conversão:  source_prefix exchange_tax </li>
                <li>Valor utilizado para conversão descontando as taxas:  source_prefix target_amount </li>
                    

<p class="warning"></p>
  
<script>
var uid = Date.parse(new Date());
$('.quotation').on('click', event => {
  let amount = $('.amount').val();
  let source = $('.source :selected').val();
  let target = $('.target :selected').val();
  let method = $('.method :selected').val();

  if(amount && amount <100000 && amount > 1000){
    dataString = 'method=' + method + '&amount=' + amount + '&source=' + source + '&target=' + target + '&token=' + uid;
    $.ajax({ type: "POST", url: "/api", data: dataString, cache: false });
  }else{
    Swal.fire('The amount to be converted must be between 1000 and 100000');
  }
});


</script>
<script > 

        var socket = io('http://'+document.domain+':2120');

        socket.on('connect', function(){
            socket.emit('login', uid);
        });

        socket.on('new_msg', function(msg){
            console.dir(msg);
            let order = JSON.parse(msg);
            Swal.fire({
                html:'<li>Moeda de origem:' + order['source_currency'] + '</li>'+
                '<li>Moeda de destino:' + order['target_currency'] + '</li>'+
                '<li>Valor para conversão:' + order['source_prefix'] + order['source_amount'] + '</li>'+
                '<li>Forma de pagamento: ' + order['method'] + '</li>'+
                '<li>Valor da "Moeda de destino" usado para conversão:' + order['target_prefix'] + order['target_value'] + '</li>'+
                '<li>Valor comprado em "Moeda de destino":' + order['target_prefix'] + order['target_total'] + '</li>'+
                '<li>Taxa de pagamento:' + order['source_prefix'] + order['payment_tax'] + '</li>'+
                '<li>Taxa de conversão:' + order['source_prefix'] + order['exchange_tax'] + '</li>'+
                '<li>Valor utilizado para conversão descontando as taxas:' + order['source_prefix']  + order['target_amount'] + '</li>'
            });
        });
        </script>

</body></html>