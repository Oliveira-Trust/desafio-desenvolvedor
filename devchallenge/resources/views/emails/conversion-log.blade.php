@component('mail::message')
hello <h1>{{ $user->name }}</h1> here's your currency conversion. {{ $conversion->origin }}

@component('mail::panel')
@component('mail::table')
| Origin        | Destiny    | Purchased Value |
|:-------------:|:-----------------:|:---------------------:| -----------------------------:|
| {{ $conversion->origin }} | {{ $conversion->destiny }} | {{ $conversion->purchased_value }} |
@endcomponent
@endcomponent

@endcomponent
