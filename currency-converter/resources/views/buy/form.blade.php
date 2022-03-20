@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form class="row g-3" method="POST" action="{{ route('currency-converter.buy')}} ">
    @csrf
    {{-- destination currency --}}
    <div class="col-auto">
      <select name="paymentType">
        @foreach ($paymentTypeOptions as $paymentType)
            <option value="{{ $paymentType['id'] }}" @selected(old('paymentType') == $paymentType)>
                {{ $paymentType['value'] }}
            </option>
        @endforeach
    </select>
  </div>
  {{-- end destination currency --}}

    {{-- payment type --}}
    {{-- <div class="col-auto">
      <select name="paymentType">
        @foreach ($paymentTypeOptions as $paymentType)
            <option value="{{ $paymentType }}" @selected(old('paymentType') == $paymentType)>
                {{ $paymentType }}
            </option>
        @endforeach
    </select>
  </div> --}}
  {{-- end payment type --}}

  {{-- value --}}
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
  </div>

    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3">{{ trans('buy.title') }}</button>
    </div>
  </form>