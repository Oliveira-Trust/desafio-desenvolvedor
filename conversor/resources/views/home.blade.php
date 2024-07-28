<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200">

    <div class="max-w-screen-lg mx-auto py-10">
        <h1 class="text-center text-3xl font-medium">Bem vindo ao Conversor de Moedas!</h1>
        <p class="text-center text-sm">Informe o valor em Reais e a moeda para qual deseja efetuar a conversão</p>

        <form action="">
            <div class="mt-20 gap-3 grid grid-cols-4 pb-7 mb-7 border-b border-solid border-gray-400">
                <div class="form-control">
                    <label for="valor">Valor em Reais (R$)</label>
                    <input type="text" id="valor" class="bg-white rounded w-full border border-gray-400 p-2">
                </div>

                <div class="form-control">
                    <label for="moeda">Moeda Desejada</label>
                    <select name="moeda" id="moeda" class="bg-white rounded w-full border border-gray-400 p-2 h-[42px]">
                        <option value="">Selecione</option>
                        <option value="us-dolar">Dólar Americano (US$)</option>
                    </select>
                </div>

                <div class="form-control">
                    <label for="moeda">Forma de Pagamento</label>
                    <select name="moeda" id="moeda" class="bg-white rounded w-full border border-gray-400 p-2 h-[42px]">
                        <option value="">Selecione</option>
                        <option value="boleto">Boleto</option>
                        <option value="cartao">Cartão de Crédito</option>
                    </select>
                </div>

                <div class="form-control">
                    <div class="flex items-center gap-3">
                        <button class="bg-blue-600 rounded mt-6 h-[42px] w-[62px]">
                            <span class="text-3xl text-gray-200">&#8644;</span>
                        </button>
                        <div>
                            <label for="resultado">Resultado</label>
                            <input type="text" id="resultado" class="bg-gray-300 rounded w-full border border-gray-400 p-2 font-semibold">
                        </div>
                    </div>
                </div>
                
            </div>
        </form>

        <div class="id" class="">
            <p class="text-end font-light text-sm hover:underline cursor-pointer">Limpar</p>
            <ul>
                <li>historio 1</li>
            </ul>
        </div>

    </div>
    
</body>
</html>