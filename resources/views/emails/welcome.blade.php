@component('mail::message')
# Hi User,

We have received your request.

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
