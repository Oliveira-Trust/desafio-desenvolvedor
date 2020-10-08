@extends('layout')
@section('content')
    <table id="table" class="display" style="width:100%" >
        <thead>
        <tr>
            @yield('headers')
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @yield('body')
        </tbody>
    </table>
    @yield('addBtn')
@endsection

