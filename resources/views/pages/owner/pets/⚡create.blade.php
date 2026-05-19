<?php

use App\enum\UserRole;
use App\Models\AnimalType;
use App\Models\Breed;
use App\Models\Pet;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

new class extends Component {

    use WithFileUploads;

    public $pets = [];
    public $animalTypes = [];
    public $breeds = [];
    public $owner;
    public $name;
    public $description;
    public $pet_image;
    public $birth_date;
    public ?Pet $pet = null;
    public int $petId;
    public  $animal_type_id;
    public  $breed_id;

    public function mount(): void
    {
        $this->owner = Auth::user();
        $this->pets = $this->owner->pets;
        $this->animalTypes = AnimalType::all();
        $this->animalTypes = AnimalType::with('breeds')->get();
    }


    function storePet(): void
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'pet_image' => 'nullable|image',
            'description' => 'required|string',
            'animal_type_id' => 'required|exists:animal_types,id',
            'breed_id' => 'nullable|exists:breeds,id',
        ]);

        $validated['user_id'] = $this->owner->id;

        if ($this->pet_image) {
            $validated['pet_image'] = $this->pet_image->store('pets', 'public');
        }

        Pet::create($validated);
        $this->reset([
            'name',
            'birth_date',
            'description',
            'pet_image',
            'animal_type_id',
            'breed_id',
        ]);

        $this->owner->refresh();
        $this->pets = $this->owner->pets;
        $this->dispatch('pet-created');
    }
    #[On('update-dog')]
    public function refreshPets(): void
    {
        $this->pets = $this->owner->fresh()->pets;
    }

    public function delete($petId): void
    {
        $pet = Pet::findOrFail($petId);
        if (!Auth::user()) {
            abort(403);
        }
        $this->name = $pet->name;
        $pet->delete();
        $this->pets = $this->owner->fresh()->pets;
        $this->dispatch('dog-deleted');

    }
};
?>

<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mx-25">
        <x-modale.pets_modale
            :animal-types="$animalTypes"
            :animal-types-id="$animal_type_id"

        />
        @foreach($pets as $pet)
            <x-cards.animal_card_owner
                :pet-id="$pet->id"
                :name="$pet->name"
                :birth-date="$pet->birthDateFormat()"
                :breed="$pet->breed?->name"
                :description="$pet->description"
                :pet-image="$pet->pet_image"
            />
            <x-modale.pets_delete_modale
                :pet-id="$pet->id"
                :name="$pet->name"
            />
        @endforeach
    </div>
</div>
