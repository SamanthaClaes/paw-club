@props(['animalId', 'userId'])

<a href="mailto:mail" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/mail.svg') }}" alt="icône de mail">
</a>
