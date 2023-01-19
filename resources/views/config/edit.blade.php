@extends('layouts.app-master')

@section('template_title')
    Update Config
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Config</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('configs.update', $config->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('config.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
