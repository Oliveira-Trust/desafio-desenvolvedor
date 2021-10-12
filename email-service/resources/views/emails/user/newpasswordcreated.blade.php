@component('mail::message')
# Olá, {{ $data['user_name'] }}!

Esta é sua nova senha: {{ $data['user_password'] }}

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
