@component('mail::message')
# Introduction

{{$token}}

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
