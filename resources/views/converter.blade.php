<x-home-layout>
    <x-cards.conversion-form-card :action="route('converter')" />

    @isset($data)
        <div class="my-6">
            <x-cards.converted-card :data="$data" />
        </div>
    @endisset
</x-home-layout>
