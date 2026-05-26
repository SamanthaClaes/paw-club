@props([
 'last_name',
 'first_name',
 'email',
 'phone',
 'adress',
 'zip',
 'location',
 'image',
])

<section class="border-2 border-stroke rounded-lg bg-card p-6 h-full">
    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">

        <div class="shrink-0">
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($image)  }}"
                alt="{{ __('petsitterProfile.profileImageAlt') }}"
                class=" w-44 h-full rounded-lg object-cover">
        </div>

        <div class="flex-1 w-full">
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                {{ __('petsitterProfile.personalInfos') }}
            </h1>

            <div class="space-y-4 text-text text-lg">
                <p>
                    <span class="font-extrabold">{{__('petsitterProfile.fullname')}} :</span>
                    {{ $last_name }} {{ $first_name }}
                </p>

                <p>
                    <span class="font-extrabold">{{ __('petsitterProfile.email') }} :</span>
                    {{ $email }}
                </p>

                <p>
                    <span class="font-extrabold">{{ __('petsitterProfile.phone') }} :</span>
                    {{ $phone }}
                </p>

                <p>
                    <span class="font-extrabold">{{ __('petsitterProfile.address') }} :</span>
                    {{ $adress }} {{ $zip }} {{ $location }}
                </p>
            </div>

            <div class="mt-8">
                <button
                    type="button"
                    @click="$dispatch('open-password-modal')"
                    class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition"
                >
                    {{ __('petsitterProfile.editInfos') }}
                </button>
            </div>
        </div>

    </div>

    <dialog
        x-data="{ open: false }"
        x-on:open-password-modal.window="
        open = true;
        $el.showModal();
    "
        x-on:password-updated.window="
        open = false;
        $el.close();
    "
        x-on:close="open = false"
        x-cloak
        class="rounded-2xl p-0 backdrop:bg-black/50 w-full mx-auto mt-20 max-w-2xl shadow-xl"
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

            <h2 class="text-2xl font-extrabold text-text uppercase mb-8">
                {{ __('petsitterProfile.editPassword') }}
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="updatePw" class="space-y-4">

                <x-forms.input-label
                    wire:model="current_password"
                    label="{{ __('petsitterProfile.currentPassword') }}"
                    name="current_password"
                    type="password"
                    placeholder="{{ __('petsitterProfile.currentPasswordPlaceholder') }}"
                />

                <x-forms.input-label
                    wire:model="password"
                    label="{{ __('petsitterProfile.newPassword') }}"
                    name="password"
                    type="password"
                    placeholder="{{ __('petsitterProfile.newPasswordPlaceholder') }}"
                />

                <x-forms.input-label
                    wire:model="password_confirmation"
                    label="{{ __('petsitterProfile.confirmPassword') }}"
                    name="password_confirmation"
                    type="password"
                    placeholder="{{ __('petsitterProfile.confirmPasswordPlaceholder') }}"
                />

                <div class="flex justify-end pt-4">
                    <button
                        type="submit"
                        class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition"
                    >
                        {{ __('petsitterProfile.changePassword') }}
                    </button>
                </div>

            </form>

        </div>

    </dialog>
</section>
