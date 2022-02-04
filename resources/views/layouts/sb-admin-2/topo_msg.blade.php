@if ($message = Session::get('success'))
    <div id="flashMessage" class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        {{ $message }}
    </div>
@endif
@if ($message = Session::get('warning'))
    <div id="flashMessage" class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        {{ $message }}
    </div>
@endif
@if ($errors->any())
    <div id="flashMessage" class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
        @foreach ($errors->all() as $error)
            {{ $error }} 
        @endforeach
    </div>
@endif