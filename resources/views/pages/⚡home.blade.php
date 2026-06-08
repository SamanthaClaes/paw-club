<?php

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;


new #[Title('Accueil | Paw-club')]
class extends Component {

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $message;
    public $submit = false;

    public function store(): void
    {
        $validated = $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);
        ContactMessage::create([...$validated, 'is_read' => false,]);
        Mail::to('samantha.claes@student.hepl.be')->queue(new ContactMessageMail($validated));
        session()->flash('success', 'Message envoyé avec succès');
        $this->submit = true;
        $this->reset(['first_name',
            'last_name',
            'email',
            'phone',
            'message',]);
    }

    public function validationAttributes(): array
    {
        return [
            'first_name' => strtolower(__('form.first_name')),
            'last_name' => strtolower(__('form.last_name')),

        ];
    }

    public function showForm(): void
    {
        $this->submit = false;
    }
};
?>

<div>
    <section class="h-[28vh] lg:h-[38vh] relative w-full  overflow-hidden" itemscope
             itemtype="https://schema.org/Organization">
        <img src="{{ asset('img/Hero_home.webp') }}" alt="pleins de chiens en balade"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4">
            <h1 itemprop="name" class="
               text-white text-2xl md:text-4xl font-bold uppercase z-10">{{ __('home.title') }}</h1>
            <span class=" text-sm text-center text-white md:text-2xl z-10 w-1/2">{{ __('home.subtitle') }}</span>
        </div>
    </section>
    <section class="px-6 py-12">
        <div class="relative mx-auto max-w-6xl border-5 border-element rounded-lg px-4 sm:px-6 lg:px-8 py-8">

            <div class="flex justify-center" id="about">
                <h2 class="text-text text-2xl sm:text-3xl uppercase font-bold mb-6 text-center ">
                    {{ __('home.about') }}
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-10">

                <img
                    src="{{ asset('img/img_home.webp')}}"
                    alt="chien blanc avec une femme"
                    class="w-full max-w-sm sm:max-w-md lg:max-w-87.5 h-auto rounded-lg object-cover"
                >

                <p class=" line-clamp-5 md:text-text text-sm  max-w-2xl mb-5 text-center lg:line-clamp-none lg:text-left lg:text-lg lg:leading-relaxed">
                    {{ __('home.aboutText') }}
                </p>
                <img
                    src="{{ asset('svg/illu_1.svg') }}"
                    alt="une femme et un homme jouant au frisbee avec un chien"
                    class="
            absolute
            bottom-0 right-0
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
            </div>
            <div class="flex justify-center mt-6">
                <a href="{{ route('petsitter.index') }}#petsitters_list"
                   class="  hover:-translate-y-1 hover:shadow-lg
        transition-all duration-300 text-cta  font-bold uppercase bg-card-green hover:bg-hover hover:text-white p-5 lg:w-1/2 rounded-lg mb-6  text-center shadow-md/10"> {{ __('home.petsitter') }}</a>
            </div>

        </div>
    </section>
    <section>
        <div class="relative">

            <h2 class="text-center text-2xl font-extrabold text-text lg:text-5xl lg:mb-10">
                {{ __('home.ourService') }}
            </h2>

            <div class="px-6 py-6 lg:flex lg:items-stretch lg:gap-10 lg:max-w-6xl lg:mx-auto">

                <div
                    class="relative border-4 w-full lg:w-1/2 border-card-orange rounded-lg sm:px-6 lg:px-8 py-8 mb-10 lg:mb-0">

                    <h3 class="text-lg mt-4 mb-4 lg:mt-8 lg:mb-8 text-center lg:text-3xl text-text font-bold">
                        {{ __('home.ourDaycare') }}
                    </h3>

                    <p class="text-sm leading-8 line-clamp-7 text-text px-6 mb-5 text-center lg:text-left lg:line-clamp-none">
                        {{ __('home.aboutDaycare') }}
                    </p>

                    <img
                        src="{{ asset('svg/icons1.svg') }}"
                        alt="garçon qui joue à la balle avec son chien"
                        class="
                        pointer-events-none
                        absolute
                        bottom-0 right-5
                        w-40 sm:w-32 md:w-40 lg:w-70
                        translate-x-1/4 translate-y-1/4
                        z-10
                    "
                    >

                    <div class="flex justify-center">
                        <a href="{{ route('daycare.request') }}"
                           class="text-text-orange font-bold uppercase bg-card-orange hover:bg-hover-orange hover:text-white p-5 lg:w-2/3 rounded-lg mb-6 shadow-md/10  hover:-translate-y-1 hover:shadow-lg
        transition-all duration-300 ">
                            {{ __('home.scheduleDaycare') }}
                        </a>
                    </div>

                </div>

                <div class="relative border-4 w-full lg:w-1/2 border-card-pink rounded-lg sm:px-6 lg:px-8 py-8">

                    <h3 class="text-lg mt-4 mb-4 lg:mt-8 lg:mb-8 text-center lg:text-3xl text-text font-bold">
                        {{ __('home.ourPetsitters') }}
                    </h3>

                    <p class="text-sm leading-8 line-clamp-6 text-text px-6 mb-5 text-center lg:text-left lg:line-clamp-none">
                        {{ __('home.aboutPetsitter') }}
                    </p>
                    <img
                        src="{{ asset('svg/illu_3.svg') }}"
                        alt="garçon qui carresse un chat"
                        class="
                        pointer-events-none
                        absolute
                        bottom-0 right-0
                        w-20 sm:w-32 md:w-40 lg:w-48
                        translate-x-1/4 translate-y-1/4
                    "
                    >

                    <div class="flex justify-center">
                        <a href="{{ route('petsitter.index') }}#petsitters_list"
                           class="shadow-md/10 text-text-pink font-bold uppercase bg-card-pink hover:bg-hover-pink hover:text-white p-5 lg:w-2/3 rounded-lg mb-6  hover:-translate-y-1 hover:shadow-lg
        transition-all duration-300">
                            {{ __('home.schedulePetsitter') }}
                        </a>
                    </div>
                </div>
            </div>
            <section
                class="flex flex-col justify-center items-center gap-4 border-2 border-card-green rounded-2xl px-6 py-10 lg:px-10 lg:py-12 my-14 shadow-sm max-w-6xl mx-auto">

                <h3 class="text-text text-2xl lg:text-3xl font-extrabold text-center leading-tight">
                    {{ __('petsitter.cardTitleAlready') }}
                </h3>

                <p class="max-w-2xl text-center text-sm lg:text-base text-text leading-7 mb-6">
                    {{ __('petsitter.cardSubtitleAlready') }}
                </p>
                    @if( Auth::user()?->is_petsitter)
                    <a
                        href="{{ route('petsitter.profile') }}"
                        title=" {{ __('petsitter.goProfile') }}"
                        class=" text-cta  font-bold uppercase bg-card-green hover:bg-hover hover:text-white p-5 lg:w-1/2 rounded-lg mb-3  text-center shadow-md/10">

                        {{ __('petsitter.already') }}
                    </a>
                    @else
                    <a
                        href="{{ route('petsitter.create') }}"
                        class=" text-cta  font-bold uppercase bg-card-green hover:bg-hover hover:text-white p-5 lg:w-1/2 rounded-lg mb-3  text-center shadow-md/10">

                        {{ __('petsitter.cardCta') }}
                    </a>
                    @endif

            </section>
        </div>
    </section>
    <section>
        <h2 class="text-text text-2xl sm:text-3xl uppercase font-bold mb-3 text-center mt-20">{{ __('home.contactUs') }} </h2>
        <span class="text-center block mb-6">
            {{ __('home.contactSubtitle') }}
        </span>

        <div class="flex justify-center">
            @if( session('success'))
                <div class="flex flex-col justify-center gap-6">
                    <x-message_success/>
                    <button wire:click="showForm"
                            class="w-full bg-element mb-6 rounded-lg text-text uppercase font-bold p-5 hover:bg-hover-element cursor-pointer mt-6">
                        {{ __('form.resent') }}
                    </button>
                </div>
            @else
                <form wire:submit="store" id="contact" class="w-8/10 lg:w-6/10">
                    <div class="flex gap-6 mt-6 justify-between">
                        <x-forms.input-label wire:model="first_name" type="text" label="{{ __('form.first_name') }}"
                                             name="first_name"
                                             placeholder="Nicole" required/>
                        <x-forms.input-label wire:model="last_name" type="text" label="{{ __('form.last_name') }}"
                                             name="last_name" placeholder="Kidman" required/>
                    </div>
                    <div class="flex gap-6 mt-6 justify-between">
                        <x-forms.input-label wire:model="email" type="email" label="{{ __('form.email') }}" name="email"
                                             placeholder="nk@mail.com" required/>
                        <x-forms.input-label wire:model="phone" type="tel" label="{{ __('form.phone') }}" name="phone"/>
                    </div>
                    <div class="mt-6 mb-6">
                        <x-forms.textarea-label
                            name="message"
                            wire:model="message"
                            label=" {{ __('form.message') }}"
                        />
                    </div>
                    <div class="mb-20">
                        <x-forms.button>
                            {{ __('form.sent') }}
                        </x-forms.button>
                    </div>
                </form>
            @endif
        </div>
    </section>
</div>
