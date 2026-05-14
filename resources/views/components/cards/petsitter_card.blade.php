@props([
    'name',
    'image',
    'description',
    'tags' => [],
    'chooseUrl' => '#',
    'contactUrl' => '#',
])

<div {{ $attributes->merge(['class' => 'border-4 border-[#7EB8BE] bg-[#EDF7F8] rounded-lg p-8 max-w-6xl mx-auto']) }}>

    <div class="flex flex-col lg:flex-row gap-8">
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

                <p class="text-[#060B3F] text-lg leading-10 max-w-4xl">
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
                   class="bg-[#FF8900] hover:bg-[#e67b00] text-[#060B3F] font-extrabold text-xl text-center py-3 rounded-xl flex-1 transition">
                    Choisir {{ $name }}
                </a>

                <a href="{{ $contactUrl }}"
                   class="bg-[#F86E78] hover:bg-[#eb5d67] text-[#060B3F] font-extrabold text-xl text-center py-3 rounded-xl flex-1 transition">
                    Contacter {{ $name }}
                </a>
            </div>
        </div>
    </div>

</div>
