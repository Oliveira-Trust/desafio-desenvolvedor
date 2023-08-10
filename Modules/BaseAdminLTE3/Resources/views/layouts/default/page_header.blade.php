@section('page_header')
    @if (isset($p))
        <section class="page-header page-header-color page-header-quaternary {{--page-header-dark --}}{{ isset($mb_none) ? 'mb-none' : '' }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            @if ($p > 1)
                                @foreach (array_splice($p, 0, -1) as $key => $value)
                                    <li>
                                        {!! getPage('site',$key, $value ) !!}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($p as $key => $value)
                            <h1>
                                {!! getPage('site',$key, $value )  !!}
                            </h1>
                        @endforeach
                        {{--<h1>{{ end($p) }}</h1>--}}
                    </div>
                </div>
            </div>
        </section>
    @endif
@show

