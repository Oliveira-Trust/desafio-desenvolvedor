@push('scripts-axios')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>
@endpush

@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

@endpush


@push('stylesheet-sign-in')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/signin.css') }}" rel="stylesheet">
@endpush