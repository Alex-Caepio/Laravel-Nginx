@component('mail::message')
# Hello

       Your token is: {{$token}} 

@component('mail::button', ['url' => 'http:://127.0.0.1:8000/api/reset/'])

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
