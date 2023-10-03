@if (session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! session('success') !!}
    </div>
@endif


@if (session('error'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! session('error') !!}
    </div>
@endif


@if (session('info'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! session('info') !!}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! session('warning') !!}
    </div>
@endif
