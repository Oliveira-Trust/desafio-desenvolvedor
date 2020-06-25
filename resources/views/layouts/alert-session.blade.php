@if (session('status'))
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="alert alert-{{ session('status.type') }}" role="alert">
            {{ session('status.message') }}
        </div>
    </div>
</div>
{{ session()->forget('status') }}
@endif