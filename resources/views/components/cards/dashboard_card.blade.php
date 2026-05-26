@props(
    [
        'title',
        'number',
        'route',
]
)
<div class="w-full">
    <a href="{{ $route }}">
        <div {{ $attributes->merge([ 'class'=>'flex flex-col items-center h-24 rounded-lg transform transition-transform duration-300 ease-in-out hover:scale-105']) }}>
            <div class=" flex justify-center pt-4">
                <p class="text-xl md:text-2xl font-bold text-text">{!! $number !!}</p>
            </div>
            <div class=" text-sm flex justify-center md:text-xl text-text font-bold uppercase ">
                {!! $title !!}
            </div>
        </div>
    </a>
</div>

