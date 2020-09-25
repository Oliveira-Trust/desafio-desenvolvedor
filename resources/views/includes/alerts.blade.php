@if ($errors->any())
    <div class="alert alert-danger mt-1 mb-1">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mt-1 mb-1">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-1 mb-1">
        {{ session('error') }}
    </div>
@endif

<div id="msgErro" class="alert alert-danger mt-1 mb-1" style="display: none">
    <p class="m-0"></p>
</div>