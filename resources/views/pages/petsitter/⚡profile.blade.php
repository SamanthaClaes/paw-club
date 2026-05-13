<?php

use App\enum\UserRole;
use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $petsitter;

    public function mount(): void
    {
        $this->petsitter = Auth::user();
    }
};
?>

<div>
    <x-header.PetsitterNav/>
    <section>
        <x-cards.ps_card_profile
            :last_name="$petsitter->last_name"
            :first_name="$petsitter->first_name"
            :email="$petsitter->email"
            :phone="$petsitter->phone"
            :adress="$petsitter->adress"
        />
    </section>
</div>
