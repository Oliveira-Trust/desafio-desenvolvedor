<div>
    @if ($operacao)
    <div class="border-t border-gray-300 pt-2">
        <div class="w-full flex justify-end">
            <button
                class="text-end font-light text-sm hover:underline cursor-pointer"
                wire:click="limpar"
            >
                Limpar
            </button>
        </div>
        <div class="mt-6 w-full">
            <table class="w-full table-auto border border-collapse">
                <tr class="bg-slate-500">
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Moeda de Origem
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Moeda de Destino
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Valor para Conversão
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Forma de Pagamento
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Valor de Conversão
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Valor Comprado
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Taxa de Pagamento
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Taxa de Coversão
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 text-slate-200"
                    >
                        Valor utilizado para conversão descontada a taxa
                    </td>
                </tr>
                @foreach ($operacao as $oper)
                <tr>
                    <td class="text-center text-sm border border-slate-800">
                        BLR
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        {{ $oper["moeda"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        R$ {{ $oper["valor"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        {{ $oper["pagamento"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        {{ $oper["valor_conversao"] }}
                    </td>
                    <td
                        class="text-center text-sm border border-slate-800 bg-emerald-200"
                    >
                        {{ $oper["valor_comprado"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        R$ {{ $oper["taxa_pagamento"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        R$ {{ $oper["taxa_conversao"] }}
                    </td>
                    <td class="text-center text-sm border border-slate-800">
                        R$ {{ $oper["valor_conversao_sem_taxa"] }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @endif
</div>
