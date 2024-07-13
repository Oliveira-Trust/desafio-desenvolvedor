@component('mail::message')
    # Report Conversion

    Hello {{ $userName }}, follow your conversion {{ $quotationName }}.

    Thanks and regards,

    {{ config('app.name') }}
@endcomponent
