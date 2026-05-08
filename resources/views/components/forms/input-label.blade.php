@props(['type', 'name', 'label', 'value' => '', 'required'=>null, 'placeholder'=>'',])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    {{$slot}}
    <label class="block text-sm  text-text uppercase font-bold mb-1" for="{{$name}}">{{$label}}</label>
    <input type="{{$type}}"
           id="{{$name}}"
           name="{{$name}}"
           value="{{ old($name, $value) }}"
           placeholder="{{$placeholder}}"
           required
           class="w-full border-2 border-black bg-white rounded-lg px-3 py-2"
           @if($required) required @endif>
    @error($name)
    <p class="text-red-500"> {{ $message }}</p>
    @enderror
</div>

