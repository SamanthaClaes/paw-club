@props(['email'])

<a href="mailto:{{ $email }}" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/mail.svg') }}" alt="icône de mail">
</a>
