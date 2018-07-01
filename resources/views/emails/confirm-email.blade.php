@component('mail::message')
# One Last Step

We just need you to confirm your email address to prove thar you're a human.You get it.

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
