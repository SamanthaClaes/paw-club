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
    public $pet_image;
    public string $email;
    public string $adress;
    public $phone;
    public $pets = [];
    public $name;
    public $birth_date;
    public $breed;
    public $description;
    public $user_id;
    public ?Pet $pet = null;
    public int $petId;


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
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'breed' => 'required|string',
            'pet_image' => 'nullable|image',
            'description' => 'required|string',
        ]);

        $validated['user_id'] = $this->owner->id;

        if ($this->pet_image) {
            $validated['pet_image'] = $this->pet_image->store('pets', 'public');
        }

        Pet::create($validated);

        $this->owner->refresh();

        $this->pets = $this->owner->pets;
        $this->dispatch('pet-created');
    }

    public function editPet($petId): void
    {
        $pet = Pet::findOrFail($petId);
        $this->pet = $pet;
        $this->name = $pet->name;
        $this->breed = $pet->breed;
        $this->birth_date = $pet->birth_date;
        $this->description = $pet->description;

        $this->dispatch('edit-dog');
    }

    public function updatePet(): void
    {
        $this->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'birth_date' => 'required|date',
            'description' => 'string',
        ]);

        $this->pet->name = $this->name;
        $this->pet->breed = $this->breed;
        $this->pet->birth_date = $this->birth_date;
        $this->pet->description = $this->description;

        $this->pet->save();
        $this->pet->refresh();
        $this->pets = $this->owner->fresh()->pets;
        $this->dispatch('update-dog');
    }

    public function delete($petId): void
    {
        $pet = Pet::findOrFail($petId);
        if (!Auth::user()){
            abort(403);
        }
        $this->name = $pet->name;
        $pet->delete();
        $this->pets = $this->owner->fresh()->pets;
        $this->dispatch('dog-deleted');

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
        <div class=" flex justify-between items-center mr-25">
            <h2 class="text-text text-2xl sm:text-3xl uppercase font-bold ml-25">Tous mes animaux</h2>
            <x-cta.add title="+ Ajouter un chien"/>
            <x-modale.pets_modale/>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mx-25">
            @foreach($pets as $pet)
                <x-cards.animal_card_owner
                    :pet-id="$pet->id"
                    :name="$pet->name"
                    :birth-date="$pet->birthDateFormat()"
                    :breed="$pet->breed"
                    :description="$pet->description"
                    :pet-image="$pet->pet_image"
                />
                <x-modale.pets_delete_modale
                    :pet-id="$pet->id"
                    :name="$pet->name"
                />
            @endforeach

        </div>
        <x-modale.pets_edit_modale/>

    </section>
</div>
