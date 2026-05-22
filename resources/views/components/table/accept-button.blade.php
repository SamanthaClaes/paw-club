

<button type="button" wire:click="acceptPetsitterRequest" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/accept.svg') }}" alt="icône accepter">
</button>
