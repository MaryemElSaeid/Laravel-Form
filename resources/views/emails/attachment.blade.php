@component('mail::message')
# Hi Admin

A new brand has requested to join.

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
