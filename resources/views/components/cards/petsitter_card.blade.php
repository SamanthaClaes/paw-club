@props([
    'name',
    'image',
    'description',
    'tags' => [],
    'chooseUrl' => '#',
    'contactUrl' => '#',
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-3']) }}>

    <div>
        <img src="{{ asset($image) }}"
             alt="{{ $name }}"
             class="rounded-full object-cover w-36 h-36">
    </div>

    <div>
        {{ $name }}
    </div>

    <div>
        {{ $description }}
    </div>

    <div class="flex gap-2 flex-wrap">
        @foreach($tags as $tag)
            <span>{{ $tag }}</span>
        @endforeach
    </div>

    <div class="flex gap-3">
        <a href="{{ $chooseUrl }}">
            choisir {{ $name }}
        </a>
        <a href="{{ $contactUrl }}">
            contacter
        </a>
    </div>

</div>
