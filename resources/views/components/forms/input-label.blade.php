@props(['type', 'name', 'label', 'value' => '', 'required'=>null, 'placeholder'=>'',])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    {{$slot}}
    <label class="block text-sm  text-text uppercase font-bold" for="{{$name}}">{{$label}}</label>
    <input type="{{$type}}"
           id="{{$name}}"
           name="{{$name}}"
           value="{{ old($name, $value) }}"
           placeholder="{{$placeholder}}"
           required
           class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background"
           @if($required) required @endif>
    @error($name)
    <p class="text-red-500"> {{ $message }}</p>
    @enderror
</div>

