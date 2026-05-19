@props([
    'name',
    'image',
    'description',
    'tags' => [],
    'chooseUrl' => '#',
    'contactUrl' => '#',
])
<div x-data="{shown : false}" x-intersect.full="shown = true">
<div x-show="shown" x-transition  {{ $attributes->merge(['class' => 'border-2 border-stroke bg-card rounded-lg p-4 max-w-4xl mx-auto mb-8']) }}>

    <div  class="flex flex-col lg:flex-row gap-8">
        <div class="shrink-0 flex justify-center">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($image)  }}"
                 alt="{{ $name }}"
                 class="rounded-full object-cover w-32 h-32">
        </div>

        <div class="flex-1 flex flex-col gap-5">
            <div>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-text mb-4">
                    {{ $name }}
                </h2>

                <p class="text-text text-lg leading-10 max-w-4xl">
                    {{ $description }}
                </p>
            </div>

            <div class="flex flex-wrap gap-4">
                @foreach($tags as $tag)
                    <span class="bg-gray-300 text-gray-600 px-10 py-1 rounded-lg text-base">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>

            <div class="border-b border-gray-300 pt-2"></div>

            <div class="flex flex-col lg:flex-row gap-6 pt-6">
                <a href="{{ $chooseUrl }}"
                   class="bg-card-orange hover:bg-hover-orange text-text font-extrabold text-xl text-center py-3 rounded-xl flex-1 transition shadow-sm">
                    Choisir {{ $name }}
                </a>

                <a href="{{ $contactUrl }}"
                   class="bg-card-pink hover:bg-hover-pink text-text font-extrabold text-xl text-center py-3 rounded-xl flex-1 transition shadow-sm">
                    Contacter {{ $name }}
                </a>
            </div>
        </div>
    </div>

</div>
</div>
