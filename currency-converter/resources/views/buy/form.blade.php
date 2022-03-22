@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form class="row" method="POST" action="{{ route('currency-converter.buy')}} ">
    @csrf
    {{-- destination currency --}}
    <div class="col-auto">
      <select name="destinationCurrency">
        @foreach ($destinationCurrencyOptions as $destinationCurrency)
            <option value="{{ $destinationCurrency }}" @selected(old('destinationCurrency') == $destinationCurrency)>
                {{ $destinationCurrency }}
            </option>
        @endforeach
    </select>
  </div>
    {{-- destination currency --}}
    {{-- paymentType --}}
    <div class="col-auto">
      <select name="paymentType">
        @foreach ($paymentTypeOptions as $paymentType)
            <option value="{{ $paymentType['id'] }}" @selected(old('paymentType') == $paymentType)>
                {{ $paymentType['value'] }}
            </option>
        @endforeach
    </select>
  </div>
  {{-- end paymentType --}}

  {{-- value --}}
  <div class="col-auto">
    <label for="value" class="visually-hidden">Password</label>
    <input type="number" step="0.01" name="value" class="form-control" id="value" min="{{$rules['floorValueToBuy']}}" max="{{$rules['ceilValueToBuy']}}" placeholder="{{$rules['floorValueToBuy']}}">
  </div>
  {{-- value --}}

    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">{{ trans('buy.title') }}</button>
    </div>
</form>