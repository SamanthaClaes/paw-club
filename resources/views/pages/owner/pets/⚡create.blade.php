<?php

use App\Jobs\ProcessImageJob;
use App\Models\AnimalType;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Créer un animal | Paw-club')]
class extends Component {

    use WithFileUploads;

    public $pets;
    public $animalTypes = [];
    public $breeds = [];
    public User $owner;
    public $name;
    public $description;
    public $pet_image = null;
    public $birth_date;
    public ?Pet $pet = null;
    public $animal_type_id;
    public $breed_id;
    public $gender;

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


    public function storePet(): void
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'birth_date' => 'required|date|before_or_equal:today',
            'pet_image' => 'image|nullable|max:10240',
            'description' => 'nullable|string',
            'gender' => 'required|boolean',
            'animal_type_id' => 'required|exists:animal_types,id',
            'breed_id' => 'nullable|exists:breeds,id',
        ]);

        $validated['user_id'] = $this->owner->id;

        if ($this->pet_image) {

            $fileName = 'pet_' . uniqid() . '.jpg';

            $path = $this->pet_image->storeAs(
                'pet/original',
                $fileName,
                's3'
            );

           ProcessImageJob::dispatchSync(
                $fileName,
                $path
            );

            $validated['pet_image'] = $path;
        }

        Pet::create($validated);
        $this->pets = $this->owner
            ->fresh()
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->get();


        $this->reset([
            'name',
            'birth_date',
            'description',
            'pet_image',
            'animal_type_id',
            'breed_id',
            'gender',
        ]);
        $this->dispatch('reset-breed-search');
        $this->dispatch('pet-created');
    }

    #[On('update-dog')]
    public function refreshPets(): void
    {
        $this->pets = $this->owner
            ->fresh()
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->get();
    }

    public function delete($petId): void
    {
        $pet = $this->owner
            ->pets()
            ->findOrFail($petId);
        $this->name = $pet->name;
        $pet->delete();
        $this->pets = $this->owner
            ->fresh()
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->get();
        $this->dispatch('dog-deleted');

    }
    public function validationAttributes(): array
    {
        return [
            'name' => strtolower(__('petModal.animalName')),
            'gender' => strtolower(__('petModal.gender')),
            'birth_date' => strtolower(__('petModal.birthDate')),
            'animal_type_id'=> strtolower(__('petModal.animalType')),
        ];
    }
};
?>

<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <x-modale.pets_modale
            :animal-types="$animalTypes"
            :animal-types-id="$animal_type_id"
        >
            @if($pet_image)
                <img class="h-40 w-40 object-cover rounded-2xl" src="{{ $pet_image->temporaryUrl() }}"
                     alt="Prévisualisation">
            @endif
        </x-modale.pets_modale>
        @foreach($pets as $pet)
            <x-cards.animal_card_owner
                :pet-id="$pet->id"
                :pet="$pet"
                :name="$pet->name"
                :birth-date="$pet->birthDateFormat()"
                :breed="__('breed.' . $pet->breed?->name)"
                :description="$pet->description"
                :pet-image="$pet->pet_image"
                :gender="$pet->gender"
            />
            <x-modale.pets_delete_modale
                :pet-id="$pet->id"
                :name="$pet->name"
            />
        @endforeach
    </div>
</div>
