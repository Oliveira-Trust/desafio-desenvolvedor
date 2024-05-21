<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 w-full max-w-6xl">

                @forelse ($quotes as $quote)
                    <div class="flex items-center p-4 bg-white rounded">
                        <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">

                            <span
                                class="font-large text-sm text-gray-800 leading-none dark:text-neutral-200">{{ $quote->getCode() }}</span>
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span
                                class="text-xl font-bold">{{ App\Models\Currency::format($quote->getBid(), $quote->getCodeIn()) }}</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">{{ $currencies[$quote->getCode()] }}</span>
                                <span
                                    class="text-green-500 text-sm font-semibold ml-2">{{ $quote->getVarBid() }}%</span>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <!-- Component End  -->
        </div>
    </div>
</x-app-layout>
