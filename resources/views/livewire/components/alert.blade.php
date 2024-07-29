<div class="">
    @if ($show && $status === 'success')
        <div
            x-data="{ show: @entangle('show') }"
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
            @alert-show.window="show = true"
            class="fixed bottom-4 right-4 bg-green-400 text-white p-4 rounded shadow-lg"
        >
            <div class="flex justify-between items-center">
                <span>{{ $message }}</span>
                <button class="ml-4" @click="show = false">✕</button>
            </div>
        </div>
    @endif
</div>
