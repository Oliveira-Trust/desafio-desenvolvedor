@component('mail::message')
# Olá, {{ $data['user_name'] }}!

Seja muito bem vindo(a)!

Clique no botão abaixo para acessar nosso sistema de cotações.<br>

@component('mail::button', ['url' => 'http://localhost:8000'])
Fazer Login
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
