<?php

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;

new  #[Title('Mon profil')]
class extends Component

{
    public User $owner;
    public $image;

    public function mount()
    {
        $this->owner = Auth::user();
    }

};

?>

<div>
    <x-cards.owner_card_profile
        :first_name="$owner->first_name"
        :last_name="$owner->last_name"
        :email="$owner->email"
        :adress="$owner->adress"
        :location="$owner->location"
        :zip="$owner->zip"
        :phone="$owner->phone"
    />
</div>
