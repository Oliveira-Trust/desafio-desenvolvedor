<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Invoice -->
                <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
                    <!-- Grid -->
                    <div
                        class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Cotação</h2>
                        </div>
                    </div>
                    <!-- End Grid -->

                    <!-- Grid -->
                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <div class="grid space-y-3">
                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Cotado para:
                                    </dt>
                                    <dd class="text-gray-800 dark:text-neutral-200">
                                        <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium dark:text-blue-500"
                                            href="#">
                                            {{ Auth::user()->email }}
                                        </a>
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Detalhes:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        <span class="block font-semibold">{{ Auth::user()->name }}</span>

                                    </dd>
                                </dl>

                            </div>
                        </div>
                        <!-- Col -->

                        <div>
                            <div class="grid space-y-3">
                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Cotação Nº:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->id }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Moeda de Origen:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->currency_origin }} - {{ $currencies[$quote->currency_origin] }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Moeda de destino:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->currency_name }} - {{ $currencies[$quote->currency_name] }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Data da Cotação:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        {{ Carbon\Carbon::parse($quote->created_at)->format('d/m/Y') }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Método de Pagamento:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $paymentMethods[$quote->payment_method] }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Table -->
                    <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <p class="font-medium text-gray-800 dark:text-neutral-200">Valor para
                                    {{ $currencies[$quote->currency_name] }}</p>
                            </div>

                            <div>
                            </div>
                            <div>
                            </div>
                            <div>

                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">
                                    BRL {{ $quote->currency_value }}</p>
                            </div>
                        </div>

                        {{-- <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div> --}}


                    </div>
                    <!-- End Table -->

                    <!-- Flex -->
                    <div class="mt-8 flex sm:justify-end">
                        <div class="w-full max-w-2xl sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Valor para conversão:
                                    </dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->conversion_amount }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Taxa de pagamento:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->payment_rate }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Taxa de conversão:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->conversion_rate }}</dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Subtotal:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->conversion_value }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Valor comprado:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $quote->converted_amount }}</dd>
                                </dl>
                            </div>
                            <!-- End Grid -->
                        </div>
                    </div>
                    <!-- End Flex -->
                </div>
                <!-- End Invoice -->
            </div>
        </div>
    </div>
</x-app-layout>
