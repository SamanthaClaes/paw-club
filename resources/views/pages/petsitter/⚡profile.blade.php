<?php

use App\enum\UserRole;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    public User $petsitter;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->petsitter = Auth::user();
    }


    public function updatePw(): void
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if ( ! Hash::check($this->current_password, $user->password)){
            $this->addError('current_password', 'Mot de passe incorrect');

            return;
        }

        $user->password = $this->password;
        $user->save();

        $this->reset([
            'current_password',
            'password',
            'password_confirmation',
        ]);

    }
};
?>

<div
    x-data="{ open: false }"
    x-on:open-password-modal.window="open = true"
>

    <x-cards.ps_card_profile
        :last_name="$petsitter->last_name"
        :first_name="$petsitter->first_name"
        :email="$petsitter->email"
        :phone="$petsitter->phone"
        :adress="$petsitter->adress"
    />

    <div
        x-show="open"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4"
    >

        <div
            @click.outside="open = false"
            x-transition
            class="bg-white rounded-2xl p-8 w-full max-w-2xl shadow-xl relative"
        >

            <button
                type="button"
                @click="open = false"
                class="absolute top-4 right-4 text-3xl text-text hover:text-red-500 transition cursor-pointer"
            >
                ×
            </button>

            <h2 class="text-2xl font-extrabold text-text uppercase mb-8">
                Modifier mon mot de passe
            </h2>

            <form wire:submit.prevent="updatePw"  x-on:submit="open = false" class="space-y-4">

                <x-forms.input-label
                    wire:model="current_password"
                    label="Mot de passe actuel"
                    name="current_password"
                    type="password"
                    placeholder="Entrez votre mot de passe actuel"
                />

                <x-forms.input-label
                    wire:model="password"
                    label="Nouveau mot de passe"
                    name="password"
                    type="password"
                    placeholder="Entrez votre nouveau mot de passe"
                />

                <x-forms.input-label
                    wire:model="password_confirmation"
                    label="Confirmer le nouveau mot de passe"
                    name="password_confirmation"
                    type="password"
                    placeholder="Confirmez votre nouveau mot de passe"
                />

                <div class="flex justify-end pt-4">
                    <button
                        type="submit"
                        class="bg-btn-green hover:bg-green-800 text-white px-6 py-3 rounded-lg font-bold uppercase transition"
                    >
                        Changer mon mot de passe
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

