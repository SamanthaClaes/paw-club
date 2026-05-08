<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::login', ['title'=>'Login'])]
class extends Component {

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $images = [
            'img/login/cat.jpg',
            'img/login/dog.jpg',
            'img/login/dog2.jpg',
        ];

        $randomImage = $images[array_rand($images)];
        return view('pages.⚡login', ['image'=>$randomImage]);
    }
};
?>

<div class="flex min-h-screen">
    <div class="w-1/2 bg-element flex flex-col items-center justify-center px-12">
        <div class="mb-8">
            <x-svg.logo class="w-89 h-89"/>
        </div>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase">
            Connectez vous
        </h1>

        <form action="" method="POST" class="w-full max-w-md flex flex-col gap-4">

            <x-forms.input-label
                label="Email"
                name="email"
                type="email"
                required
            />

            <x-forms.input-label
                label="Mot de passe"
                name="password"
                type="password"
                required
            />

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
    </div>

    <div class="w-1/2">
        <img src="{{ asset($image) }}" alt="plusieurs images de chiens ou de chats"
             class="w-full h-full object-cover">
    </div>

</div>
