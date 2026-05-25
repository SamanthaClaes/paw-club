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

<section class="border-4 border-stroke rounded-lg bg-card p-6 max-w-5xl mx-auto mt-20 mb-30">
    <div class="flex flex-col gap-8">

        <h1 class="uppercase font-extrabold text-text lg:text-3xl text-center">
            {{ __('ownerProfile.personalInfos') }}
        </h1>

        <div class="flex flex-col lg:flex-row gap-10 items-center lg:items-start">

            <div class="shrink-0">
                <img
                    src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                    alt="{{ __('ownerProfile.profileImageAlt') }}{{ Auth::user()->first_name }}"
                    class="w-44 h-44 rounded-lg object-cover"
                >
            </div>

            <div class="flex-1 w-full">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 text-text text-lg">

                    <p>
                        <span class="font-extrabold">{{ __('ownerProfile.fullname') }} :</span><br>
                        {{ $last_name }} {{ $first_name }}
                    </p>

                    <p>
                        <span class="font-extrabold">{{ __('ownerProfile.email') }} :</span><br>
                        {{ $email }}
                    </p>

                    <p>
                        <span class="font-extrabold">{{ __('ownerProfile.phone') }}:</span><br>
                        {{ $phone }}
                    </p>

                    <p>
                        <span class="font-extrabold">{{ __('ownerProfile.address') }} :</span><br>
                        {{ $adress }} {{ $zip }} {{ $location }}
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">

                    <button
                        type="button"
                        @click="$dispatch('open-password-modal')"
                        class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition cursor-pointer"
                    >
                        {{ __('ownerProfile.editPassword') }}
                    </button>

                    <button
                        type="button"
                        @click="$dispatch('open-datas-modal')"
                        class="w-full bg-btn-green hover:bg-green-800 text-white font-extrabold uppercase rounded-lg py-3 transition cursor-pointer"
                    >
                        {{ __('ownerProfile.editInfos') }}
                    </button>

                </div>

            </div>

        </div>

    </div>

    <x-modale.owner_password_modale/>
    <x-modale.owner_profile_modale/>
</section>
