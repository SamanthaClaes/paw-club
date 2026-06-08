<?php

use App\Enums\DayCareRequestStatus;
use App\Models\DayCareRequest;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Demande de garde | Paw-club')]
class extends Component {
    use WithFileUploads;

    public User $user;
    public $first_name;
    public $last_name;
    public $pet_id;
    public $pets = [];
    public $image;
    public $infos;
    public $gender;
    public string $start_date = '';
    public string $end_date = '';

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


        if ($this->pets->count() === 1) {
            $this->pet_id = $this->pets->first()->id;
        }
    }

    public function updatedPetId($value): void
    {
        $pet = $this->pets->firstWhere('id', $value);

        $this->gender = $pet?->gender;
    }


    public function store(): void
    {
        $validated = $this->validate([
            'image' => 'nullable|image',
            'infos' => 'nullable|string',
            'pet_id' => 'required|exists:pets,id',
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

        $validated['pet_id'] = $this->user
            ->pets()
            ->where('animal_type_id', 1)
            ->findOrFail($validated['pet_id'])
            ->id;
        if ($this->image) {

            $validated['image'] = $this->image->store('daycare', 'public');
        }
        $validated['user_id'] = $this->user->id;
        $validated['status'] = DayCareRequestStatus::PENDING;
        $request = DayCareRequest::create($validated);
        session()->flash('success', 'Demande envoyée avec succès');
        $this->reset([
            'image',
            'infos',
            'pet_id',
            'start_date',
            'end_date',
        ]);

    }

    #[Computed]
    public function selectedAnimal()
    {
        return $this->pets->firstWhere('id', $this->pet_id);
    }
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20">
            {{ __('formDaycare.title') }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h1>
        <p class="block text-text text-sm text-center mb-6 w-1/2 mx-auto"> {{ __('formDaycare.subtitle') }}
            <span class="font-bold text-text"> {{ __('formDaycare.advice') }} </span></p>
    </section>
    @if($this->pets->isEmpty())
        <div class="rounded-xl border bg-card border-stroke p-6 w-8/10 mx-auto">
            <p class="font-medium text-lg">
                Vous ne possédez actuellement aucun chien.
            </p>

            <p class="mt-2 text-sm text-gray-600">
                La garderie n'accepte que les chiens. Ajoutez un chien à votre profil afin de pouvoir effectuer une demande de garde.
            </p>

            <div class="mt-6">
                <a
                    href="{{ auth()->user()->petsitter
                ? route('petsitter.profile')
                : route('owner.profile') }}"
                    class="inline-flex items-center justify-center
                   hover:-translate-y-1 hover:shadow-lg
                   transition-all duration-300
                   text-cta font-bold uppercase
                   bg-card-green hover:bg-hover hover:text-white
                   px-6 py-4 rounded-lg shadow-md/10"
                >
                    Ajouter un chien à mon profil
                </a>
            </div>
        </div>
    @else
    <form wire:submit="store" class="w-8/10 mx-auto" enctype="multipart/form-data">
        <div class="flex gap-6">
            <x-forms.select-option wire:model.live="pet_id" label="{{ __('formDaycare.nameAndBreed') }}" name="pet_id">
                <option value="">{{ __('formDaycare.chooseAnimal') }}</option>
                @foreach( $this->pets as $pet)
                    <option value="{{ $pet->id }}">
                        {{ $pet->name }} - {{ __( 'breed.' . $pet->breed?->name)}}
                    </option>
                @endforeach
            </x-forms.select-option>
            @if($this->selectedAnimal)

                <div>
                        <span
                            class="block text-sm  text-text uppercase font-bold mb-1">{{ __('formDaycare.animalPicture') }}
                        </span>
                    <div>
                    <img
                        src="{{ $this->selectedAnimal->getImageUrl(800) }}"
                        srcset="
        {{ $this->selectedAnimal->getImageUrl(400) }} 400w,
        {{ $this->selectedAnimal->getImageUrl(800) }} 800w,
        {{ $this->selectedAnimal->getImageUrl(1200) }} 1200w
    "
                        sizes="(max-width: 768px) 100vw, 320px"
                        alt="{{ $this->selectedAnimal->name }}"
                        class="w-80 h-80 object-cover rounded-2xl"
                    >
                    </div>
                </div>

            @endif
        </div>
        <div class="flex gap-6">
            <x-forms.input-label type="date" wire:model="start_date" name="start_date"
                                 label="{{ __('formDaycare.startDate') }}"/>
            <x-forms.input-label type="date" wire:model="end_date" name="end_date"
                                 label="{{ __('formDaycare.endDate') }}"/>
        </div>
        <div>
            <label for="infos" class="text-text font-bold uppercase">{{ __('formDaycare.infos') }}</label>
            <textarea wire:model="infos" name="infos" id="infos" cols="30" rows="10"
                      class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
        </div>
        <div>
            <x-forms.button>
                {{ __('formDaycare.sent') }}
            </x-forms.button>
        </div>
    </form>
    @endif
    <div class="w-1/2 mx-auto mb-6">
    @if( session('success'))
        <x-message_success/>
    @endif
    </div>
</div>
