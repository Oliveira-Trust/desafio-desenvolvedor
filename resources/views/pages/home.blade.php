<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="w-full bg-white text-gray-800">
            <div class="mt-10">
                <h2 class="uppercase tracking-wider xs:text-sm lg:text-xl font-semibold border-l-4 border-yellow-400 pl-2 mt-5">Conversor de moeda nacional para moeda estrangeira</h2>
                    
                <div class="mt-8" x-data="porcentagem()">
                    <form @submit.prevent="calcular()">
                    <div class="md:flex mt-2">
                        <div class="mr-0 md:mr-2 mt-2 md:mt-0">
                            <label class="mt-4 mb-1 uppercase text-xs font-bold">Valor em Real a ser convertido</label>
                            <div class="flex">
                                <span class="flex items-center px-3 font-bold">R$</span>
                                <input type="text" class="py-2 rounded w-full" x-model="amount" @keyup="moedaMask()" placeholder="1.000,00" required>
                            </div>                                
                        </div>
                        <div class="mr-0 md:mr-2 mt-2 md:mt-0">
                            <label class="mt-4 mb-1 uppercase text-xs font-bold">Moeda</label>
                            <div class="flex">
                                <select class="rounded w-full" x-model="v.currency_code" required>
                                    <option value="">Selecione</option>
                                    <option value="USD">Dólar</option>
                                    <option value="EUR">Euro</option>
                                    <option value="JPY">Iene</option>
                                </select>
                            </div>
                        </div>
                        <div class="mr-0 md:mr-2 mt-2 md:mt-0">
                            <label class="mt-4 mb-1 uppercase text-xs font-bold">Pagamento</label>
                            <div class="flex">
                                <select class="rounded w-full" x-model="v.payment_method" required>
                                    <option value="">Selecione</option>
                                    <option value="boleto">Boleto</option>
                                    <option value="cartao">Cartão</option>                                        
                                </select>
                                <span class="hidden md:flex items-center pl-2 font-bold">=</span>
                            </div>
                        </div>
                        <div class="mr-0 md:mr-2 mt-2 md:mt-0">
                            <label class="mt-4 mb-1 uppercase text-xs font-bold">Você recebe</label>
                            <div class="flex">
                                <input type="text" class="py-2 rounded w-full border" x-model="resultado" readonly>
                            </div>
                        </div>
                        <div class="flex mt-3 items-start justify-center">
                            <div class="flex w-full mt-3">
                                <button
                                    class="w-full px-4 py-2 font-medium tracking-wide text-white border capitalize bg-blue-500 rounded hover:bg-blue-400 focus:outline-none focus:bg-blue-500">
                                    Calcular
                                </button>
                            </div>
                        </div>
                    </div>
                    <p style="display: none" x-show="valorRange" class="text-red-500 mt-2">O valor deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00</p>
                    <div style="display: none" x-show="resultado">
                        <p class="font-semibold mt-3">Comissão: <span class="text-green-500" x-text="moedaFormaBRL(v.tax)"></span></p>
                    </div>
                </form>
                </div>
            </div>
            <div class="mt-10">
                <a href="{{ route('currency-quotes')}}"
                    class="underline text-blue-400 text-lg font-semibold hover:text-blue-600">Ver meu histórico de cotações!</a>
            </div>
        </div>
    </div>

    @push('scripts_up')
    <script>
        function porcentagem() {
            return {
                v:{
                    amount_row: '',
                    currency_code: '',
                    payment_method: '',
                    tax: '', // Taxa cobrada após coversão 
                    final_amount: '',
                },
                amount: '',
                taxa: {'boleto' : 1.45, 'cartao' : 7.63},
                valorRange: false,
                resultado: '',
                calcular() {
                    if(this.amount != '' && Number(this.moedaToRaw(this.amount)) >= 1000 && Number(this.moedaToRaw(this.amount)) <= 100000){
                        fetch('https://economia.awesomeapi.com.br/json/last/BRL-'+this.v.currency_code).then(response => {
                            return response.json();
                        }).then(data => {
                            this.v.tax = this.porcentagem(Number(this.moedaToRaw(this.amount)));
                            this.v.amount_row = Number(this.moedaToRaw(this.amount));
                            this.v.final_amount = Number(data['BRL' + this.v.currency_code].bid) * (Number(this.moedaToRaw(this.amount) - this.v.tax));
                            this.resultado = (Number.isNaN(this.v.final_amount)) ? 'Valor inválido' : this.moedaFormat(this.v.final_amount);

                            @if (Auth::check())
                            axios.post('/historico-de-cotacoes', this.v)
                            .then(function (response) {
                            })
                            .catch(function (error) {
                                alert( 'Erro ao cadastrar!' );
                            });
                            @endif
                        });
                        this.valorRange = false
                    }else{
                        this.valorRange = true
                        this.resultado = ''
                    }                   
                },
                moedaMask() {
                    let v = this.amount;
                    v = v.replace(/\D/g,'');
                    v = (v/100).toFixed(2).replace(".", ","); + '';
                    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
                    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
                    this.amount = v;                    
                },
                moedaToRaw(v) {
                    v = v.split('.').join("").replace(/,/g, '.');
                    v = parseFloat(v).toFixed(2);
                    return v;
                },
                moedaFormat(v) {
                    return Intl.NumberFormat('en-us', {
                        style: 'currency',
                        currency: this.v.currency_code,
                        minimumFractionDigits: 2
                    }).format(v);
                },
                moedaFormaBRL(v) {
                    return Intl.NumberFormat('pt-br', {
                        style: 'currency',
                        currency: 'BRL',
                        minimumFractionDigits: 2
                    }).format(v);
                },
                porcentagem(v){
                    let taxaDeConversao = (v <= 3000) ? 2 : 1;
                    let taxaDePagamento = Number(this.taxa[this.v.payment_method]);
                    return (v / 100) * (taxaDeConversao + taxaDePagamento);
                },
                submitData() {
                    fetch('/historico-de-cotacoes', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(this.amount)
                    })
                    .then(() => {
                        alert('Sucesso!');
                    })
                    .catch(() => {
                        alert('Algo deu errado!');
                    });
                }
            }
        }
    </script>
    @endpush

</x-app-layout>
