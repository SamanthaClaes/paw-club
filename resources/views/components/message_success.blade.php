
    <div
        wire:ignore
         x-data="{ show: false }"
         x-init="
    setTimeout(() => {
        show = true;

        setTimeout(() => {
            show = false;
        }, 4000);
    }, 100);
"
         x-show="show"
         x-cloak
        x-transition.opacity.duration.300ms
         class="
    w-full
    rounded-lg
    border-2 border-success
    bg-success-bg
    text-success-text
    text-center
    font-bold
    px-4 py-3
    shadow-md
">
        <p>
       {{ session('success') }}
        </p>

    </div>
