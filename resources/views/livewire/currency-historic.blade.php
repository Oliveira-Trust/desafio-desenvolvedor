<div class="flex-1 ">
    <div class="bg-white rounded-2xl p-4 shadow-sm">
        <h2 class="text-lg font-medium">Histórico</h2>

        <div class="flex flex-col gap-y-1.5 mt-3">
            @foreach($historic as $item)
                <div class="w-full p-2 rounded-lg border-base-red border border-l-8 text-sm shadow">
                    <div class="flex flex-row justify-between">
                        <p><span class="text-base-red font-[600]">Valor conversão: </span>{{$item->amount}}</p>
                        <p><span
                                class="text-base-red font-[600]">Conversão com taxas: </span>{{$item->amount_after_taxes}}
                        </p>
                    </div>

                    <div class="flex flex-row justify-between">
                        <p>{{$item->source_currency}} <span
                                class="text-base-red font-[600]">></span> {{$item->destination_currency}}</p>
                        <p><span class="text-base-red font-[600]">Total em {{$item->destination_currency}}
                            :</span> {{number_format($item->converted_amount, 2, ',', '.')}}</p>
                    </div>
                    <div class="flex flex-row justify-between mt-2">
                        <p><span
                                class="text-base-red font-[600]">Valor da moeda:</span> {{number_format((1 / $item->rate), 2, ',', '.')}}
                        </p>
                        <p><span class="text-base-red font-[600]">Valor da moeda:</span> {{$item->payment_method}}</p>
                    </div>

                    <div class="w-full flex justify-end mt-2 text-xs">
                        <span class="text-zinc-400">{{ $item->created_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
            @endforeach

            @if(!count($historic))
                <p class="text-zinc-500">Você ainda não fez nem uma conversão.</p>
            @endif

            {{ $historic->links() }}
        </div>
    </div>
</div>
