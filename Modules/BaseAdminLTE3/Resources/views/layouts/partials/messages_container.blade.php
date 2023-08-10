@section('messages_container')
    @section('message')
        @if (Session::has('flash_notification'))
            <div class="container mt-2">
                {{--<div class="col-12">--}}
                    @include('baseportobs4::layouts.partials.message')
                {{--</div>--}}
            </div>
        @endif
    @show

    @section('errors')
        @if ($errors->any())
            <div class="container mt-2">
                {{--<div class="col-12">--}}
                    @include('baseportobs4::layouts.partials.errors')
                {{--</div>--}}
            </div>
        @endif
    @show
{{--<br>--}}
@show
