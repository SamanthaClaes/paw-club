@props(['animalId', 'userId'])

<button type="button" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/delete.svg') }}" alt="icône pour supprimer">
</button>
