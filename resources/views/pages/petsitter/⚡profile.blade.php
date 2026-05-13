<?php

use App\enum\UserRole;
use App\Models\User;
use Livewire\Component;

new class extends Component {
    public $petsitters;

    public function mount(): void
    {
        $this->petsitters = User::where('role', UserRole::PETSITTER)->get();
    }
};
?>

<div>
    <x-header.PetsitterNav/>
    <section>
        @foreach($petsitters as $petsitter)
        <x-cards.ps_card_profile
            :name="$petsitter->name"
            :email="$petsitter->email"
            :phone="$petsitter->phone"
            :adress="$petsitter->adress"
        />
        @endforeach
    </section>
</div>
