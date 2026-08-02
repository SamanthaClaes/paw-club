@props(['animalId', 'userId'])

<button type="button" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/refuse.svg') }}" alt="{{ __('ui.refuse_icon') }}">
</button>
