<?php

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::login', ['title' => 'Login'])]
class extends Component {
    public string $type = "password";
    public string $password;
    public string $image;

    public function mount(): void
    {
        $images = [
            'img/login/cat.jpg',
            'img/login/dog.jpg',
            'img/login/dog2.jpg',
        ];
        $this->image = $images[array_rand($images)];
    }
    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('pages.⚡login');
    }

    public function togglePassword(): void
    {
        if ($this->type === 'password') {
            $this->type = 'text';
        } else {
            $this->type = 'password';
        }
    }
};


?>

<div class="grid grid-cols-1 lg:grid-cols-2 min-h-screen">
    <section class="bg-element flex flex-col items-center justify-center px-12">
        <div>
            <x-svg.logo class="w-89 h-89 mb-8"/>
        </div>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase">
            Connectez vous
        </h1>
        <form wire:submit.prevent class="w-full max-w-md flex flex-col gap-4">

            <x-forms.input-label
                label="Email"
                name="email"
                type="email"
                placeholder="user@mail.be"
            />

            <div>
                <label class="block text-sm  text-text uppercase font-bold mb-1"  for="password">Mot de passe</label>
                <div class="relative w-full">
                    <input type="{{ $type  }}" wire:model="password" placeholder="entrez votre mot de passe"
                           class="w-full border-2 border-black bg-white rounded-lg px-3 py-2">
                    <button type="button"  wire:click="togglePassword" class="absolute inset-y-0 right-2 flex  items-center text-sm cursor-pointer">
                        <img src="{{ $type === 'password' ? asset('svg/v.svg') : asset('svg/v_off.svg') }}" alt="">
                    </button>
                </div>
            </div>

            <button type="submit" class="bg-text text-white py-3 rounded-lg font-bold uppercase">
                Se connecter
            </button>

            <div class="text-sm text-center mt-2">
                <a href="#" class="underline">Pas encore de compte ?</a>
            </div>

            <div class="text-sm text-center">
                <a href="#" class="underline">Mot de passe oublié ?</a>
            </div>

        </form>
    </section>

    <div class=" hidden lg:block h-screen">
        <img src="{{ asset($this->image) }}" alt="plusieurs images de chiens ou de chats"
             class="w-full h-full object-cover">
    </div>

</div>
