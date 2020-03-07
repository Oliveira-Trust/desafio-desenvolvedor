@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product
                    <a href={{ URL::previous() }} >
                        <button class="btn btn-danger float-right">
                            <i class="fas fa-window-close"></i>
                            {{ __('Back') }}
                        </button>
                    </a>

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    @if(count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{$error}}
                            </div>

                        @endforeach
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
                                <form id="principal" action="{{route('product.store')}}" method="post">
                                    @endif
                                    <div class="form-group">
                                        @csrf
                                        <label for="name" class="">Name</label>
                                        <input type="text" name="name" id="name" value="{{$model->name}}"
                                            class="form-control">
                                        <br />
                                        <label for="ean" class="">Ean</label>
                                        <input type="text" name="ean" id="ean" value="{{$model->ean}}"
                                            class="form-control">
                                        <br />
                                        <label for="price" class="">Price</label>
                                        <input type="text" name="price" id="price" value="{{$model->price}}"
                                            class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        {{ __('Save') }}
                                    </button>
                                </fieldset>

                                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
