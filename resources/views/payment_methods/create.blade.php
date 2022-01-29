<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Métodos de pagamento - Cadastramento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action={{route('payment_methods.store')}} method="post">
                        @csrf
                        <input type="hidden" id="redirect_to" name="redirect_to" value={{URL::previous()}}>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label for="title">Título do método de pagamento</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                            <div class="col-md-2 col-sm-12 mt-6">
                                <label for="fabricante">Taxa do método</label>
                                <input type="text" id="fee" name="fee" class="form-control">
                            </div>

                        </div>
                        <div class="row mt-6">
                            <div class="col-md-12 col-sm-12">
                                <button type="submit" style="background: blue;" class="btn btn-blue btn-primary">CADASTRAR</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
