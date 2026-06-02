@props([
 'last_name',
 'first_name',
 'email',
 'phone',
 'adress',
 'zip',
 'location',
 'petsitter',
])

<section class="border-2 border-stroke rounded-2xl bg-card p-8 h-full max-w-5xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6 items-center lg:items-start">

        <div class="shrink-0">
          {{--  <img
                src="{{ Storage::disk('s3')->url($petsitter->image) }}"
                srcset="
        {{ $petsitter->getImageUrl(400) }} 400w,
        {{ $petsitter->getImageUrl(800) }} 800w,
        {{ $petsitter->getImageUrl(1200) }} 1200w
    "
                sizes="(max-width: 768px) 100vw, 400px"
                alt="{{ __('petsitterProfile.profileImageAlt') }}"
                class="w-40 h-40 rounded-2xl object-cover"
            >--}}
        </div>

        <div class="flex-1 w-full">
            <h1 class="uppercase font-extrabold text-text text-2xl mb-6">
                {{ __('petsitterProfile.personalInfos') }}
            </h1>

            <div class="space-y-5 text-text text-base">
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

            <div class="mt-8 flex flex-col md:flex-row gap-3 w-full">

                <button
                    type="button"
                    @click="$dispatch('open-password-modal')"
                    class="flex-1 bg-btn-green hover:bg-hover-green text-white font-bold uppercase rounded-xl px-4 py-3 transition cursor-pointer text-sm text-center"
                >
                    {{ __('petsitterProfile.changePassword') }}
                </button>

                <button
                    type="button"
                    @click="$dispatch('open-update-data-modal')"
                    class="flex-1 bg-btn-green hover:bg-hover-green text-white font-bold uppercase rounded-xl px-4 py-3 transition cursor-pointer text-sm text-center"
                >
                    {{ __('petsitterProfile.editInfos') }}
                </button>

            </div>
        </div>

    </div>
    <x-modale.owner_password_modale/>
    <x-modale.petsitter_profile_modale/>
</section>
