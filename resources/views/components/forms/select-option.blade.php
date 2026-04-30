@props([
    'name',
    'label',
    'required' => false,
])
<div {{ $attributes}} class="w-1/2">
    <label for="{{ $name }}" class="block text-sm text-text uppercase font-bold">
        {{ $label }}
    </label>

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background"
    >
        {{ $slot }}
    </select>

    @error($name)
    <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
