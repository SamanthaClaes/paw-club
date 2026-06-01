<?php

use App\enum\UserRole;
use App\Enums\PetsitterRequestStatus;
use App\Jobs\ProcessImageJob;
use App\Mail\PetsitterRequestMail;
use App\Models\PetSittingRequest;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades;
use Livewire\Attributes\Title;

new #[Title('Demander une garde')]
class extends Component {
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

        if ($this->pets->count() === 1) {
            $this->pet_id = $this->pets->first()->id;
        }
    }

    #[Computed]
    public function selectedAnimal()
    {
        return $this->pets->firstWhere('id', $this->pet_id);
    }

    public function validationAttributes(): array
    {
        return [
            'start_date' => strtolower(__('formDaycare.startDate')),
            'end_date' => strtolower(__('formDaycare.endDate')),
            'pet_id'=> strtolower('animal'),
        ];
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

            $fileName = 'pet_' . uniqid() . '.jpg';

            $path = $this->image->storeAs(
                'pet/original',
                $fileName,
                'public'
            );

            ProcessImageJob::dispatch(
                $fileName,
                $path
            );

            $validated['image'] = $path;
        }

        $request = PetSittingRequest::create($validated);
        Mail::to($this->petsitter->email)->queue(new PetsitterRequestMail(
            $this->user,
            $this->petsitter,
            $pet,
            $request
        ));

        $this->reset([
            'image',
            'start_date',
            'end_date',
            'description',
            'pet_id',
        ]);
        session()->flash('success', 'Demande envoyée avec succès');
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
            @if($pets->count()===1)
                <div class="flex flex-col gap-2">
                    <span
                        class="block text-sm  text-text uppercase font-bold mb-1">{{ __('formDaycare.nameAndBreed') }}</span>
                    <div class="border-2 border-element rounded-lg p-2">
                        {{ $pets->first()->name }}
                        -
                        {{ $pets->first()->breed->name }}
                    </div>

                </div>
            @else
                <x-forms.select-option wire:model.live="pet_id" label="{{ __('formDaycare.nameAndBreed') }}"
                                       name="pet_id">
                    <option value="">{{ __('formDaycare.chooseAnimal') }}</option>
                    @foreach( $pets as $pet)
                        <option value="{{ $pet->id }}">
                            {{ $pet->name }} - {{$pet->breed->name}}
                        </option>
                    @endforeach
                </x-forms.select-option>
            @endif
            <div class=" flex flex-col gap-3">
                @if($this->selectedAnimal)

                    <div class="mt-6 mb-6 flex flex-col gap-3">
                        <span
                            class="block text-sm  text-text uppercase font-bold mb-1">{{ __('formDaycare.animalPicture') }}</span>
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

                @endif
            </div>
            <div class="flex gap-6">
                <x-forms.input-label type="date" wire:model="start_date" name="start_date"
                                     label="{{ __('formDaycare.startDate') }}"/>
                <x-forms.input-label type="date" wire:model="end_date" name="end_date"
                                     label="{{ __('formDaycare.endDate') }}"/>
            </div>
            <div class="mt-6">
                <x-forms.textarea-label
                    name="description"
                    wire:model="description"
                    label="{{ __('petModal.description') }}"
                />

            </div>
            <div class="lg:mb-20">
                <x-forms.button>
                    {{ __('formDaycare.candidate') }}
                </x-forms.button>
            </div>
        </div>
    </form>
    <div class="w-1/2 mx-auto">
        @if( session('success'))
            <x-message_success/>
        @endif
    </div>
</div>
