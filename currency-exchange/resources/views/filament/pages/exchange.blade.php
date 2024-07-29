<x-filament::page>
  <div class="space-y-4">
    <form wire:submit.prevent="submit" class="space-y-4">
      {{ $this->form }}
    </form>

    <div class="font-bold text-xl text-center">
      Exchange History
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full table-auto border px-4 py-2">
        <thead>
          <tr>
            <th class="px-4 py-2">Origin Currency</th>
            <th class="px-4 py-2">End Currency</th>
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Payment method</th>
            <th class="px-4 py-2">New Currency amount</th>
            <th class="px-4 py-2">Payment fee</th>
            <th class="px-4 py-2">Conversion fee</th>
            <th class="px-4 py-2">Amount converted</th>
          </tr>
        </thead>
        <tbody class='text-center'>
          @foreach ($this->getTableData() as $row)
          <tr>
            <td class="border px-4 py-2">{{ $row['origin_currency'] }}</td>
            <td class="border px-4 py-2">{{ $row['end_currency'] }}</td>
            <td class="border px-4 py-2">{{ $row['amount'] }}</td>
            <td class="border px-4 py-2">{{ $row['payment_method']['name'] }}</td>
            <td class="border px-4 py-2">{{ $row['end_currency_amount'] }}</td>
            <td class="border px-4 py-2">{{ $row['payment_fee'] }}</td>
            <td class="border px-4 py-2">{{ $row['conversion_fee'] }}</td>
            <td class="border px-4 py-2">{{ $row['amount_converted'] }}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-filament::page>