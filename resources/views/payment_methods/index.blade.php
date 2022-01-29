<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Métodos de pagamento <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">NOVO MÉTODO DE PAGAMENTO</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('message')" />

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Taxa</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($itens as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->fee }}</td>
                                <td>
                                    <ul class="list-inline">
                                        <li><a href="{{ route('payment_methods.edit', $item->id) }}" class="btn btn-info">Editar</a></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
