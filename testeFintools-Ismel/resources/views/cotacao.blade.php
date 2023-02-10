@extends("layouts.layout")

@section("seccion1")

<div id="app">

    <v-convercao :user="{{ Auth::user() }}"></v-convercao>
                
</div>

@endsection