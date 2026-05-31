@props([
    'label',
    'name',
])

<div>
    <label
        for="{{ $name }}"
        class="text-text font-bold uppercase"
    >
        {{ $label }}
    </label>

    <textarea
        {{ $attributes }}
        id="{{ $name }}"
        name="{{ $name }}"
        rows="6"
        class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"
    ></textarea>

    @error($name)
    <p class="text-red-500 text-sm mt-1">
        {{ $message }}
    </p>
    @enderror
</div>
