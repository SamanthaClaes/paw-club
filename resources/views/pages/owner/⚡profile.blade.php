<?php

use App\Models\Pet;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

new  #[Title('Mon profil')]
class extends Component {
    use WithFileUploads;

    public User $owner;
    public $image;
    public string $email;
    public string $adress;
    public string $phone;
    public $pets = [];

    public function mount(): void
    {
        $this->owner = Auth::user();
        $this->email = $this->owner->email;
        $this->adress = $this->owner->adress;
        $this->phone = $this->owner->phone;
        $this->pets = $this->owner->pets;
    }

    public function storePet(): void
    {
        $validated = $this->validate([
            'name'=>'required|string',
            'age'=>'required|max_digits:2',
            'breed'=>'required|string',
            'image'=>'nullable|image'
        ]);

        $pet = Pet::create($validated);
        if ($this->image) {

            $path = $this->image->store('pets', 'public');

            $pet->image = $path;

            $pet->save();
        }
    }

    public function store(): void
    {

        if ($this->image) {

            $path = $this->image->store('owner', 'public');

            $this->owner->image = $path;
            $this->owner->save();
            $this->owner->refresh();
        }
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

    public function updateData(): void
    {
        $this->validate([
            'email' => 'required',
            'adress' => 'required|string',
            'phone' => 'nullable|max_digits:10',
        ]);
        $this->owner->email = $this->email;
        $this->owner->adress = $this->adress;
        $this->owner->phone = $this->phone;

        $this->owner->save();
        $this->owner->refresh();
    }
};


?>

<div>
    <x-cards.owner_card_profile
        :first_name="$owner->first_name"
        :last_name="$owner->last_name"
        :email="$email"
        :adress="$adress"
        :location="$owner->location"
        :zip="$owner->zip"
        :phone="$phone"
        :image="$owner->image"
    />
    <section>
        <h2 class="text-text text-2xl sm:text-3xl uppercase font-bold ml-25 mt-30">Tous mes animaux</h2>
        <div class=" flex justify-end mt-6 mr-25">
            <x-cta.add title="+ Ajouter un chien"/>
        </div>
        <div>
            @foreach($pets as $pet)
                <x-cards.animal_card_owner
                />
            @endforeach
        </div>
    </section>
</div>
