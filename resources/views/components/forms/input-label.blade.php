@props([
    'type',
    'name',
    'label',
    'required' => null,
    'placeholder' => '',
])

<div class="w-full">

    <label
        class="block text-sm text-text uppercase font-bold mb-1"
        for="{{ $name }}"
    >

        {{ $label }}
        @if($required)
            <abbr title="champ obligatoire">*</abbr>
        @endif
    </label>

    <input
        {{ $attributes->merge([
            'class' => 'w-full border-2 border-element bg-white rounded-lg px-3 py-2 mb-6'
        ]) }}
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
    >

    @error($name)
    <p class="text-red-500">{{ $message }}</p>
    @enderror

</div>
