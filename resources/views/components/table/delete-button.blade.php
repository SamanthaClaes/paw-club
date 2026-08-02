

<button type="button" {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <img src="{{ asset('svg/delete.svg') }}" alt="{{ __('ui.delete_icon') }}">
</button>
