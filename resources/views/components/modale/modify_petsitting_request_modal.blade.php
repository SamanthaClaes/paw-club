<dialog
    wire:ignore.self
    x-data="{ open: false }"

    x-on:open-modify-modal.window="
        open = true;
        document.documentElement.classList.add('overflow-hidden');
        document.body.classList.add('overflow-hidden');
        $el.showModal();
    "

    x-on:close-modify-modal.window="
        open = false;
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
        $el.close();
    "

    x-on:close="
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    "

    x-cloak
    class="rounded-2xl
    backdrop:bg-black/50
    w-full
    max-w-2xl
    shadow-xl
    fixed
    top-1/2
    left-1/2
    -translate-x-1/2
    -translate-y-1/2
    m-0"
>

    <div
        x-show="open"
        x-transition
        @click.outside="
            open = false;
            $el.closest('dialog').close();
        "
        class="bg-white rounded-2xl p-8 relative"
    >

        <button
            type="button"
            @click="
                open = false;
                $el.closest('dialog').close();
            "
            class="absolute top-4 right-4 text-3xl text-text hover:text-red-500 transition cursor-pointer"
        >
            ×
        </button>

        <h2 class="text-2xl font-extrabold text-text uppercase mb-6">
            Modifier la demande
        </h2>
        <form wire:submit="updateRequests">
            <div class="flex gap-6">
                <x-forms.input-label
                    type="date"
                    wire:model="requested_start_date"
                    name="requested_start_date"
                    label="{{ __('formDaycare.startDate') }}"
                />
                <x-forms.input-label
                    type="date"
                    wire:model="requested_end_date"
                    name="requested_end_date"
                    label="{{ __('formDaycare.endDate') }}"
                />
            </div>
            <div>
                <label for="message" class="text-text font-bold uppercase">Message</label>
                <textarea name="requested_description" id="message" cols="30" rows="10"
                          wire:model="requested_description"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 mb-6 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
            </div>

            <div class="flex justify-center gap-6">
                <button
                    type="submit"
                    class="border-2 border-gray-300 px-6 py-3 rounded-lg font-bold uppercase hover:bg-gray-100 transition cursor-pointer"
                >
                    Envoyer la demande
                </button>

            </div>
        </form>
    </div>

</dialog>
