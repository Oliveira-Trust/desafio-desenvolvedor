@extends('../app')
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">{{config('app.name')}}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        </ul>
        <span class="navbar-text">
            {{Auth::user()->name}}
        </span>
        <span class="navbar-text">
          <form action="{{route('logout')}}" method="post">@csrf<button class="btn btn-dark btn-sm" type="submit">logout</button></form>
        </span>
      </div>
    </div>
  </nav>
<div class="container">

    <form class="row" method="POST" action="{{route('currencyQuote.toConvert')}}">
        @csrf
    <div class="form-group col-2">
        <label>Currency of origin:</label>
        <input type="text" name="currency_origin" readonly value="{{$options['currencyOrigin'][0]->value}}" class="@error('currency_origin') is-invalid @enderror form-control form-control-sm">
        @error('currency_origin')
        <div class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
    <div class="form-group col-2">
        <label>Target currency:</label>
        <select class="@error('target_currency') is-invalid @enderror form-select form-select-sm" name="target_currency">
            @foreach ($options['currencyTarget'] as $currency)
                <option value="{{$currency->value}}">{{$currency->value}}</option>
                @endforeach
            </select>
        @error('target_currency')
            <div class="invalid-feedback">
            {{$message}}
          </div>
        @enderror
    </div>
    <div class="form-group col-2">
        <label>Value:</label>
        <input type="text" name="value" class="@error('value') is-invalid @enderror form-control form-control-sm" value="{{old('value')}}">
        @error('value')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group col-2">
        <label>Payment method:</label>
        <select class="@error('payment_method') is-invalid @enderror form-select form-select-sm" name="payment_method">
            @foreach ($options['paymentMethod'] as $method)
                <option value="{{$method->value}}">{{$method::getView($method->value)}}</option>
                @endforeach
            </select>
            @error('payment_method')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group col-2 pt-4">
            <button type="submit" class="btn btn-dark btn-sm">to convert</button>
        </div>
    </form>

    @isset($quotationHistory)
    <table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Currency Origin</th>
            <th scope="col">Target Currency</th>
            <th scope="col">Value Origin</th>
            <th scope="col">With Discount</th>
            <th scope="col">Payment method</th>
            <th scope="col">Rate Payment</th>
            <th scope="col">Rate Convert</th>
            <th scope="col">Value Target Currency</th>
            <th scope="col">Value Base Convert</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($quotationHistory as $quota)
            <tr>
                <td>{{$quota->currency_origin}}</td>
                <td>{{$quota->target_currency}}</td>
                <td>{{$quota->value_origin}}</td>
                <td>{{$quota->value_origin_with_discount}}</td>
                <td>{{$quota->payment_method}}</td>
                <td>{{$quota->rate_payment}}</td>
                <td>{{$quota->rate_convert}}</td>
                <td>{{$quota->value_target_currency}}</td>
                <td>{{$quota->value_base_convert}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endisset
@endsection
