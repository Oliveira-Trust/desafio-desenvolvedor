<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchases') }}
        </h2>
    </x-slot>
    
</x-app-layout>
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Origin Currency</th>
                        <th scope="col">Destination Currency</th>
                        <th scope="col">Value</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Payment Fee</th>
                        <th scope="col">Convertion Fee</th>
                        <th scope="col">Total Received</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchaseId => $purchase)
                    <tr>
                        <th scope="row">{{$purchaseId}}</th>
                        <td>{{ $purchase->origin_currency }}</td>
                        <td>{{ $purchase->destination_currency }}</td>
                        <td>{{ $purchase->value }}</td>
                        <td>{{ $purchase->payment_type }}</td>
                        <td>{{ $purchase->payment_fee }}</td>
                        <td>{{ $purchase->convertion_fee }}</td>
                        <td>{{ $purchase->selling_price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
