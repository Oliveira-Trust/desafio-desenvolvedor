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
                        <!-- Col -->

                        {{-- <div class="inline-flex gap-x-2">
                            <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                                href="#">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="7 10 12 15 17 10" />
                                    <line x1="12" x2="12" y1="15" y2="3" />
                                </svg>
                                Invoice PDF
                            </a>
                            <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                href="#">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 6 2 18 2 18 9" />
                                    <path
                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                                    <rect width="12" height="8" x="6" y="14" />
                                </svg>
                                Print
                            </a>
                        </div> --}}
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Grid -->
                    <div class="grid md:grid-cols-2 gap-3">
                        <div>
                            <div class="grid space-y-3">
                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Billed to:
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
                                        Billing details:
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
                                    BRL R$ {{ $quote->currency_value }}</p>
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
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">R$
                                        {{ $quote->conversion_amount }}
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Taxa de pagamento:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$2750.00
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Taxa de conversão:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$39.00</dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Subtotal:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$2789.00
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Valor comprado:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                        {{ formatCurrency($quote->converted_amount, $quote->currency_name) }}</dd>
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
