@props(['email'])

<a href="mailto:{{ $email }}" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/mail.svg') }}" alt="{{ __('ui.mail_icon') }}">
</a>
