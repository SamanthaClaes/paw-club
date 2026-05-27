<?php

use App\enum\UserRole;
use App\Enums\PetsitterRequestStatus;
use App\Models\PetSittingRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;


    public string $start_date = '';
    public string $end_date = '';
    public string $description = '';
    public $image;
    public User $petsitter;
    public $pets = [];
    public $user;
    public $pet_id;

    public function mount(User $user): void
    {
        $this->petsitter = $user;
        $this->user = Auth::user();
        $this->pets = $this->user
            ->pets()
            ->with('breed')
            ->get();
    }

    public function store(): void
    {
        $validated = $this->validate([
            'image' => 'nullable|image',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'description' => 'nullable|string',
            'pet_id' => 'required|exists:pets,id',
        ]);

        $pet = $this->user
            ->pets()
            ->findOrFail($validated['pet_id']);

        $validated['pet_id'] = $pet->id;

        $validated['user_id'] = $this->user->id;

        $validated['petsitter_id'] = $this->petsitter->id;

        $validated['status'] = PetsitterRequestStatus::PENDING;

        if ($this->image) {

            $validated['image'] = $this->image->store('animals', 'public');
        }

        PetSittingRequest::create($validated);

        $this->reset([
            'image',
            'start_date',
            'end_date',
            'description',
            'pet_id',
        ]);
    }
}
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20"> {{ __('petsitterRequestForm.title') }} {{ $petsitter->first_name }}</h1>
        <span class="block text-text text-sm text-center mb-6"> {{ __('petsitterRequestForm.subtitle') }}</span>
    </section>
    <form wire:submit="store" class="w-8/10 mx-auto" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-3">
            <x-forms.select-option wire:model="pet_id" label="{{ __('formDaycare.nameAndBreed') }}" name="pet_id">
                <option value="">{{ __('formDaycare.chooseAnimal') }}</option>
                @foreach( $pets as $pet)
                    <option value="{{ $pet->id }}">
                        {{ $pet->name }} - {{$pet->breed->name}}
                    </option>
                @endforeach
            </x-forms.select-option>
            <div class="mt-6">
                <x-forms.input-label wire:model="image" name="image" label="{{ __('formDaycare.animalPicture') }}" type="file"/>
            </div>
            <div class="flex gap-6">
                <x-forms.input-label type="date" wire:model="start_date" name="start_date"
                                     label="{{ __('formDaycare.startDate') }}"/>
                <x-forms.input-label type="date" wire:model="end_date" name="end_date" label="{{ __('formDaycare.endDate') }}"/>
            </div>
            <div class="mt-6">
                <label for="description" class="block text-sm  text-text uppercase font-bold mb-1">{{ __('formDaycare.infos') }}</label>
                <textarea wire:model="description" name="description" id="description" cols="30" rows="10"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none mb-6"></textarea>
            </div>
            <div class="lg:mb-20">
                <x-forms.button>
                    {{ __('formDaycare.sent') }}
                </x-forms.button>
            </div>
        </div>
    </form>
</div>
