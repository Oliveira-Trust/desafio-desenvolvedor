@extends('layouts.app')

@section('content')

<script>
        $(document).ready(function() {
            $('#clientSelect').select2();
        });
        </script>
<div class="container">

            <div class="card">
                <div class="card-header">{{ __('Select Client to Create the order') }}</div>
                <div class="card-body">


                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
                                <select id="clientSelect" name="client" class="form-control">
                                    @foreach ($clients as $item)
                                    <option value={{$item->id}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>





                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar pedido!') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



@endsection
