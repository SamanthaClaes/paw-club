<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\Pet;
use App\Models\User;
use LaravelIdea\Helper\App\Models\_IH_Pet_C;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Demande de garde')]
class extends Component {
    use WithFileUploads;

    public User $user;
    public $first_name;
    public $last_name;
    public $pet_id;
    public $pets = [];
    public $selectedPet = null;
    public $image;
    public $infos;
    public $user_id;
    public $gender;
    public string $start_date = '';
    public string $end_date = '';
    public $status;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->pets = $this->user
            ->pets()
            ->with('breed')
            ->where('animal_type_id', 1)
            ->get();
    }

    public function store(): void
    {
        $validated = $this->validate([
            'image' => 'nullable|image',
            'infos' => 'nullable|string',
            'pet_id' => 'required|exists:pets,id',
            'gender' => 'required|boolean',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $pet = $this->user
            ->pets()
            ->with([
                'breed',
                'animalType',
            ])
            ->where('animal_type_id', 1)
            ->findOrFail($this->pet_id);
        $validated['user_id'] = Auth::id();
        $validated['status'] = DayCareRequestStatus::PENDING;
        $request = DayCareRequest::create($validated);

        if ($this->image) {

            $path = $this->image->store('daycare', 'public');

            $request->image = $path;

            $request->save();
        }
        $this->reset();
    }
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">
            Bonjour {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h1>
        <p class="block text-text text-sm text-center mb-6 w-1/2 mx-auto">En remplissant ce formulaire, vous envoyez une
            demande de
            garde à notre garderie, une réponse vous sera envoyée dans les plus brefs délais.
            <span class="font-bold text-text">N’oubliez pas que notre garderie ne s’occupe que des chiens</span></p>
    </section>
    <form wire:submit="store" class="w-8/10 mx-auto" enctype="multipart/form-data">
        @csrf
        <div class="flex gap-6">
            <x-forms.select-option wire:model.live="pet_id" label="Nom et race de l'animal" name="pet_id">
                <option value="">Choisir mon animal</option>
                @foreach( $this->pets as $pet)
                    <option value="{{ $pet->id }}">
                        {{ $pet->name }} - {{$pet->breed->name}}
                    </option>
                @endforeach
            </x-forms.select-option>
            <x-forms.input-label
                wire:model="image"
                name="image"
                type="file"
                label="Photo de l’animal"
            />
        </div>
        <div>
            <x-forms.select-option
                wire:model="gender"
                name="gender"
                label="Genre"
            >
                <option value="">Choisissez un genre</option>

                <option value="1">
                    Mâle
                </option>

                <option value="0">
                    Femelle
                </option>

            </x-forms.select-option>
        </div>
        <div class="flex gap-6">
            <x-forms.input-label type="date" wire:model="start_date" name="start_date"
                                 label="Date de début de garde"/>
            <x-forms.input-label type="date" wire:model="end_date" name="end_date" label="Date de fin de garde"/>
        </div>
        <div>
            <label for="infos" class="text-text font-bold uppercase">Informations supplémentaires</label>
            <textarea wire:model="infos" name="infos" id="" cols="30" rows="10"
                      class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
        </div>
        <div>
            <x-forms.button>
                Envoyez ma demande
            </x-forms.button>
        </div>
    </form>
</div>
