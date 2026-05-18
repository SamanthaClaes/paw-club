<?php

use App\Models\AnimalType;
use App\Models\Breed;
use App\Models\Pet;
use Livewire\Component;

new class extends Component {
    public $owner;

    public $pets = [];

    public $animalTypes = [];

    public $breeds = [];

    public $name;

    public $animal_type_id;

    public $breed_id;

    public $birth_date;

    public $description;

    public ?Pet $pet = null;

    public function mount(): void
    {
        $this->owner = Auth::user();

        $this->pets = $this->owner->pets;

        $this->animalTypes = AnimalType::all();

        $this->breeds = Breed::all();
    }

    public function editPet($petId): void
    {
        $pet = Pet::findOrFail($petId);
        $this->pet = $pet;
        $this->name = $pet->name;
        $this->animal_type_id = $pet->animal_type_id;
        $this->breed_id = $pet->breed_id;
        $this->birth_date = $pet->birth_date;
        $this->description = $pet->description;

        $this->dispatch('edit-dog');
    }

    public function updatePet(): void
    {
        $this->validate([
            'name' => 'required|string',
            'animal_type_id' => 'required|exists:animal_types,id',
            'breed_id' => 'nullable|exists:breeds,id',
            'birth_date' => 'required|date',
            'description' => 'string',
        ]);

        $this->pet->name = $this->name;
        $this->pet->animal_type_id = $this->animal_type_id;
        $this->pet->breed_id = $this->breed_id;
        $this->pet->birth_date = $this->birth_date;
        $this->pet->description = $this->description;

        $this->pet->save();
        $this->pet->refresh();
        $this->pets = $this->owner->fresh()->pets;
        $this->dispatch('update-dog');
    }
};
?>

<div>
    <x-modale.pets_edit_modale/>
</div>
