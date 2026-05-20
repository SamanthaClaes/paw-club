<?php

use App\Models\AnimalType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

new class extends Component {
    public User $petsitter;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $types = [];

    public function mount(): void
    {
        $this->petsitter = Auth::user();
        $this->types = AnimalType::all();

    }


    public function updatePw(): void
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {
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
        $this->dispatch('password-updated');
    }
};
?>
<section>
    <h1 class=" text-text text-2xl text-center font-bold mb-4 lg:text-3xl mt-20">Mes informations</h1>
    <x-header.PetsitterNav/>
    <div class="grid grid-cols-2 mt-20 mb-20 gap-8">
        <x-cards.ps_card_profile
            :last_name="$petsitter->last_name"
            :first_name="$petsitter->first_name"
            :email="$petsitter->email"
            :phone="$petsitter->phone"
            :adress="$petsitter->adress"
            :zip="$petsitter->zip"
            :location="$petsitter->location"
            :image="$petsitter->image"
        />

        <x-cards.ps_card_profile_info
            :type="$petsitter->animalTypes->pluck('type')->join(', ')"
            :visit="$petsitter->visitTypes->pluck('name')->join(', ')"

        />
    </div>
</section>
