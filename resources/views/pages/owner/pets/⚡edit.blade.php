<?php

use App\Jobs\ProcessImageJob;
use App\Models\AnimalType;
use App\Models\Pet;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

new #[Title('Editer un animal | Paw-club')]
class extends Component {
    use WithFileUploads;

    public $owner;

    public $pets = [];

    public $animalTypes = [];

    public $breeds = [];

    public $name;

    public $animal_type_id;

    public $breed_id;

    public $birth_date;

    public $description;

    public $pet_image;

    public ?Pet $pet = null;

    public function mount(): void
    {
        $this->owner = Auth::user();
        $this->pets = $this->owner
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->get();
        $this->animalTypes = AnimalType::with('breeds')->get();
    }

    #[On('edit-pet')]
    public function editPet($petId): void
    {
        $pet = $this->owner
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->findOrFail($petId);

        $this->pet = $pet;
        $this->name = $pet->name;
        $this->animal_type_id = $pet->animal_type_id;
        $this->breed_id = $pet->breed_id;
        $this->birth_date = $pet->birth_date;
        $this->pet_image = null;
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
            'pet_image' => 'image|nullable|max:10240',
            'description' => 'nullable|string',
        ]);
        if ($this->pet_image) {

            $fileName = 'pet_' . uniqid() . '.jpg';

            $path = $this->pet_image->storeAs(
                'pet/original',
                $fileName,
                's3'
            );

            ProcessImageJob::dispatchSync($fileName, $path);

            $this->pet->pet_image = $path;
        }
        $this->pet->name = $this->name;
        $this->pet->animal_type_id = $this->animal_type_id;
        $this->pet->breed_id = $this->breed_id;
        $this->pet->birth_date = $this->birth_date;
        $this->pet->description = $this->description;

        $this->pet->save();
        $this->reset([
            'name',
            'animal_type_id',
            'breed_id',
            'birth_date',
            'description',
        ]);
        $this->pet = null;
        $this->pets = $this->owner
            ->fresh()
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->get();
        $this->dispatch('update-dog');
    }
};
?>

<div>
    <x-modale.pets_edit_modale
        :animal-types="$animalTypes"
        :animal-types-id="$animal_type_id"
    />
</div>
