@include('flash::message')

@if ($errors->any())
    <div class="alert alert-danger mb-3" role="alert">
        <h4 class="alert-heading">Atenção</h4>
        @foreach($errors->getMessages() as $error)
            <div class="alert-body">{{ $error[0] }}</div>
        @endforeach
    </div>
@endif
