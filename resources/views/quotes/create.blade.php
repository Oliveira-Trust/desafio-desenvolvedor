<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Card -->
                <div
                    class="p-4 md:p-5 min-h-[410px] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                                Income
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                $126,238.49
                            </p>
                        </div>

                        <div>
                            <span
                                class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-teal-100 text-teal-800 dark:bg-teal-500/10 dark:text-teal-500">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                25%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->

                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                            Payment
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Manage your payment methods.
                        </p>
                    </div>

                    <form>
                        <!-- Section -->
                        <div
                            class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                            <label for="af-payment-billing-contact"
                                class="inline-block text-sm font-medium dark:text-white">
                                Billing contact
                            </label>

                            <div class="mt-2 space-y-3">
                                <input id="af-payment-billing-contact" type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="First Name">
                                <input type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Last Name">
                                <input type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Phone Number">
                            </div>
                        </div>
                        <!-- End Section -->

                        <!-- Section -->
                        <div
                            class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                            <label for="af-payment-billing-address"
                                class="inline-block text-sm font-medium dark:text-white">
                                Billing address
                            </label>

                            <div class="mt-2 space-y-3">
                                <input id="af-payment-billing-address" type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Street Address">
                                <input type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Apt, Syuite, Building (Optional)">
                                <div class="grid sm:flex gap-3">
                                    <input type="text"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Zip Code">
                                    <select
                                        class="py-2 px-3 pe-9 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected>City</option>
                                        <option>City 1</option>
                                        <option>City 2</option>
                                        <option>City 3</option>
                                    </select>
                                    <select
                                        class="py-2 px-3 pe-9 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected>State</option>
                                        <option>State 1</option>
                                        <option>State 2</option>
                                        <option>State 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- End Section -->

                        <!-- Section -->
                        <div
                            class="py-6 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                            <label for="af-payment-payment-method"
                                class="inline-block text-sm font-medium dark:text-white">
                                Payment method
                            </label>

                            <div class="mt-2 space-y-3">
                                <input id="af-payment-payment-method" type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Name on Card">
                                <input type="text"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Card Number">
                                <div class="grid sm:flex gap-3">
                                    <input type="text"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Expiration Date">
                                    <input type="text"
                                        class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="CVV Code">
                                </div>
                            </div>
                        </div>
                        <!-- End Section -->
                    </form>

                    <div class="mt-5 flex justify-end gap-x-2">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                            Cancel
                        </button>
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save changes
                        </button>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="p-4 md:p-5 min-h-[410px] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                                Visitors
                            </h2>
                            <p class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                80.3k
                            </p>
                        </div>

                        <div>
                            <span
                                class="py-[5px] px-1.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-md bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500">
                                <svg class="inline-block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="m19 12-7 7-7-7" />
                                </svg>
                                2%
                            </span>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="p-4 sm:p-7 overflow-y-auto">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Invoice from Preline
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-neutral-500">
                                Invoice #3682303
                            </p>
                        </div>

                        <!-- Grid -->
                        <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-3 gap-5">
                            <div>
                                <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">Amount
                                    paid:</span>
                                <span
                                    class="block text-sm font-medium text-gray-800 dark:text-neutral-200">$316.8</span>
                            </div>
                            <!-- End Col -->

                            <div>
                                <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">Date
                                    paid:</span>
                                <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">April 22,
                                    2020</span>
                            </div>
                            <!-- End Col -->

                            <div>
                                <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">Payment
                                    method:</span>
                                <div class="flex items-center gap-x-2">
                                    <svg class="size-5" width="400" height="248" viewBox="0 0 400 248"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path d="M254 220.8H146V26.4H254V220.8Z" fill="#FF5F00" />
                                            <path
                                                d="M152.8 123.6C152.8 84.2 171.2 49 200 26.4C178.2 9.2 151.4 0 123.6 0C55.4 0 0 55.4 0 123.6C0 191.8 55.4 247.2 123.6 247.2C151.4 247.2 178.2 238 200 220.8C171.2 198.2 152.8 163 152.8 123.6Z"
                                                fill="#EB001B" />
                                            <path
                                                d="M400 123.6C400 191.8 344.6 247.2 276.4 247.2C248.6 247.2 221.8 238 200 220.8C228.8 198.2 247.2 163 247.2 123.6C247.2 84.2 228.8 49 200 26.4C221.8 9.2 248.6 0 276.4 0C344.6 0 400 55.4 400 123.6Z"
                                                fill="#F79E1B" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="400" height="247.2" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">••••
                                        4242</span>
                                </div>
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Grid -->

                        <div class="mt-5 sm:mt-10">
                            <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Summary
                            </h4>

                            <ul class="mt-3 flex flex-col">
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Payment to Front</span>
                                        <span>$264.00</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Tax fee</span>
                                        <span>$52.8</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Amount paid</span>
                                        <span>$316.8</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Button -->
                        <div class="mt-5 flex justify-end gap-x-2">
                            <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-neutral-800 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
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
                        <!-- End Buttons -->

                        <div class="mt-5 sm:mt-10">
                            <p class="text-sm text-gray-500 dark:text-neutral-500">If you have any questions, please
                                contact
                                us at <a
                                    class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium dark:text-blue-500"
                                    href="#">example@site.com</a> or call at <a
                                    class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline font-medium dark:text-blue-500"
                                    href="tel:+1898345492">+1 898-34-5492</a></p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>

        </div>
    </div>
</x-app-layout>
