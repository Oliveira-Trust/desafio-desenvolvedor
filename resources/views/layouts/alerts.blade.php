@php  $lista = ['success','info','error','warning'];  @endphp
@foreach ($lista as $type) 
    @if(Session::has($type))
    <div class="alert alert-{{$type}}" role="alert">
        {{ Session::get($type) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
@endforeach