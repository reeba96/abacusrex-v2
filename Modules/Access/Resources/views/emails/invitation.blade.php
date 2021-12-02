@component('mail::message')
#{{ __('invitation.title') }}

{{ __('invitation.body') }}

@component('mail::button', ['url' => $invitation->getLInk(),'color' => 'primary'])
{{ __('invitation.button_text') }}
@endcomponent

{{ __('invitation.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
