<div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    @if($alert['msg'])
        <div class="alert alert-{{$alert['tipo']}}" role="alert">{{$alert['msg']}}</div>
    @endif
    <div class="card">
        <div class="row row-bordered g-0" >
            @if (!$isConversaoRealizada)
                @include('livewire.form')
            @else
                @include('livewire.resultado')
            @endif
        </div>
    </div>
</div>



