<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Configuração das taxas pelo valor da transação
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('message')" />

                    <form action={{ route('payment_fees.update', $item) }} method="POST">
                        
                        @csrf
                        
                        @method('PUT')

                        <input type="hidden" id="redirect_to" name="redirect_to" value={{URL::previous()}}>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 mt-6">
                                <label for="title">Taxa percentual aplicada em transações até R$ 3000,00</label>
                                <input type="number" min="0.00" max="100.00" step="0.01"
                                         id="fee_1" name="fee_1" class="form-control col-md-1" value="{{ $item->fee_1 }}">
                            </div>
                            <div class="col-md-12 col-sm-12 mt-6">
                                <label for="title">Taxa percentual aplicada em transações acima de R$ 3000,00</label>
                                <input type="number" min="0.00" max="10000.00" step="0.01"
                                         id="fee_2" name="fee_2" class="form-control col-md-1" value="{{ $item->fee_2 }}">
                            </div>

                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" style="background-color: blue;" class="btn btn-blue btn-primary">ATUALIZAR</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
