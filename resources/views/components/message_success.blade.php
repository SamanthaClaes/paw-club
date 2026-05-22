
    <div
         x-data="{ show: false }"
         x-init="
        setTimeout(() => show = true, 100);
        setTimeout(() => show = false, 4000);
    "
         x-show="show"
         x-cloak
         x-transition:enter="transform transition duration-700 ease-out"
         x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transform transition duration-500 ease-in"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
         class="bg-green-100 border border-green-400 text-green-800 text-center font-bold px-4 py-3 rounded-lg mb-6 w-full mx-auto">
        <p>
       {{ session('success') }}
        </p>

    </div>
