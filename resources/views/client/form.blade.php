@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Client</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($show ?? false)
                    <fieldset disabled="disabled">
                    @else
                    <fieldset>
                    @endif

                            @if (isset($model->id))
                            <form id="principal" action="{{'/'.explode('/', Route::current()->uri)[0].'/'.$model->id}}"
                                method="post">
                                @method('PUT')
                                @else
                                <form id="principal" action="{{route('client.store')}}" method="post">
                                    @endif
                                    <div class="form-group">
                                        @csrf
                                        <label for="name" class="">Name</label>
                                        <input type="text" name="name" id="name" value="{{$model->name}}"
                                            class="form-control">
                                        <br />
                                        <label for="phone" class="">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{$model->phone}}"
                                            class="form-control">
                                        <br />
                                        <label for="address" class="">Address</label>
                                        <input type="text" name="address" id="address" value="{{$model->address}}"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        {{ __('Save') }}
                                    </button>
                                </form>
                            </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
