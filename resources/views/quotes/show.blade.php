<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Invoice -->
                <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
                    <!-- Grid -->
                    <div
                        class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Invoice</h2>
                        </div>
                        <!-- Col -->

                        <div class="inline-flex gap-x-2">
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
                        </div>
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
                                            sara@site.com
                                        </a>
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Billing details:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        <span class="block font-semibold">Sara Williams</span>
                                        <address class="not-italic font-normal">
                                            280 Suzanne Throughway,<br>
                                            Breannabury, OR 45801,<br>
                                            United States<br>
                                        </address>
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Shipping details:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        <span class="block font-semibold">Sara Williams</span>
                                        <address class="not-italic font-normal">
                                            280 Suzanne Throughway,<br>
                                            Breannabury, OR 45801,<br>
                                            United States<br>
                                        </address>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <!-- Col -->

                        <div>
                            <div class="grid space-y-3">
                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Invoice number:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        ADUQ2189H1-0038
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Currency:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        USD - US Dollar
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Due date:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        10 Jan 2023
                                    </dd>
                                </dl>

                                <dl class="grid sm:flex gap-x-3 text-sm">
                                    <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                        Billing method:
                                    </dt>
                                    <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                        Send invoice
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <!-- Col -->
                    </div>
                    <!-- End Grid -->

                    <!-- Table -->
                    <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                        <div class="hidden sm:grid sm:grid-cols-5">
                            <div
                                class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Item</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty</div>
                            <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Rate</div>
                            <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Amount</div>
                        </div>

                        <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">Design UX and UI</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">5</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$500</p>
                            </div>
                        </div>

                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">Web project</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">24</p>
                            </div>
                            <div>
                                <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$1250</p>
                            </div>
                        </div>

                        <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>

                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            <div class="col-span-full sm:col-span-2">
                                <h5
                                    class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Item</h5>
                                <p class="font-medium text-gray-800 dark:text-neutral-200">SEO</p>
                            </div>
                            <div>
                                <h5
                                    class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Qty</h5>
                                <p class="text-gray-800 dark:text-neutral-200">1</p>
                            </div>
                            <div>
                                <h5
                                    class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Rate</h5>
                                <p class="text-gray-800 dark:text-neutral-200">6</p>
                            </div>
                            <div>
                                <h5
                                    class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Amount</h5>
                                <p class="sm:text-end text-gray-800 dark:text-neutral-200">$2000</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->

                    <!-- Flex -->
                    <div class="mt-8 flex sm:justify-end">
                        <div class="w-full max-w-2xl sm:text-end space-y-2">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Subotal:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$2750.00
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Total:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$2750.00
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Tax:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$39.00</dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Amount paid:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$2789.00
                                    </dd>
                                </dl>

                                <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                                    <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Due balance:</dt>
                                    <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">$0.00</dd>
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
