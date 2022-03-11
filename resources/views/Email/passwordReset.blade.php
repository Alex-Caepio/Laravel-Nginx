@component('mail::message')
# Hello your token is:

{{$token}}

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Press
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
