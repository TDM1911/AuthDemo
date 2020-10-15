@component('mail::message')
# Account info

You have successfully logged into AuthDemo using Github.
Here's your default password.

** Password: {{ $password }} **

Thank for reading.<br>
=================
{{ config('app.name') }}
@endcomponent
