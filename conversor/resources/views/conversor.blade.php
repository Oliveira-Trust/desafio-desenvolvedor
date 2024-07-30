
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
                <div class="max-w-screen-lg mx-auto py-10">
                    <h1 class="text-center text-3xl font-medium">
                        Bem vindo ao Conversor de Moedas!
                    </h1>
                    <p class="text-center text-sm">
                        Informe o valor em Reais e a moeda para qual deseja efetuar a
                        conversão
                    </p>
            
                    <form wire:submit.prevent="converter">
                        <div class="mt-20 gap-3 grid grid-cols-4 pb-4">
                            <div class="form-control">
                                <label for="valor">Valor em Reais (R$)</label>
                                <input
                                    type="text"
                                    name="valor"
                                    id="valor"
                                    wire:model="valor"
                                    x-mask:dynamic="$money($input, ',')"
                                    class="bg-white text-slate-700 rounded w-full border border-gray-400 p-2"
                                    autofocus
                                />
                                <p class="text-xs text-red-500 mt-1">
                                    @error('valor') {{ $message }} @enderror
                                </p>
                            </div>
            
                            <div class="form-control">
                                <label for="moeda">Moeda Desejada</label>
                                <select
                                    wire:model="moeda"
                                    name="moeda"
                                    id="moeda"
                                    class="bg-white text-slate-700 rounded w-full border border-gray-400 p-2 h-[42px]"
                                >
                                    <option value="">Selecione</option>
                                    @foreach ($moedas as $value)
                                    <option
                                        value="{{ $value['code'] }}|{{ $value['bid'] }}"
                                        wire:key="{{ $value['code'] }}"
                                    >
                                        {{ $value["name"] }}
                                    </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-red-500 mt-1">
                                    @error('moeda') {{ $message }} @enderror
                                </p>
                            </div>
            
                            <div class="form-control">
                                <label for="pagamento">Forma de Pagamento</label>
                                <select
                                    wire:model="pagamento"
                                    name="pagamento"
                                    id="pagamento"
                                    class="bg-white text-slate-700 rounded w-full border border-gray-400 p-2 h-[42px]"
                                >
                                    <option value="">Selecione</option>
                                    <option value="Boleto">Boleto</option>
                                    <option value="Cartao de Crédito">
                                        Cartão de Crédito
                                    </option>
                                </select>
                                <p class="text-xs text-red-500 mt-1">
                                    @error('pagamento') {{ $message }} @enderror
                                </p>
                            </div>
            
                            <div class="form-control">
                                <button
                                    type="button"
                                    wire:click="converter"
                                    class="bg-blue-600 hover:bg-blue-700 transition rounded mt-6 h-[42px] w-full flex items-center justify-center"
                                >
                                    <span class="text-3xl text-white">&#8644;</span>
                                    <span class="text-md text-white font-semibold ml-2"
                                        >Converter</span
                                    >
                                </button>
                            </div>
                        </div>
                    </form>
            
                    <div class="flex h-16 w-full mb-2">
                        <div class="flex gap-3 justify-center w-full items-center">
                            <span class="">Valor convertido:</span>
                            <h2 class="text-2xl font-bold" x-show="$wire.resultado">
                                {{ $resultado }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-5">
        <livewire:historico :operacao="$operacao" />
    </div>
</div>
