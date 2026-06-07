<?php

use App\enum\UserRole;
use App\Enums\PetsitterStatus;
use App\Jobs\ProcessImageJob;
use App\Models\AnimalType;
use App\Models\Habitation;
use App\Models\User;
use App\Models\VisitType;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new  #[Title('Devenir petsitter | Paw-club')]
class extends Component {

    use WithFileUploads;

    public string $last_name = '';
    public string $first_name = '';
    public string $phone = '';
    public string $email = '';
    public string $adress = '';
    public string $zip = '';
    public string $habitation_id = '';
    public $animals = [];
    public $animalTypes = [];
    public $habitations = [];
    public $visits = [];
    public $visitTypes = [];
    public $image;
    public string $location;
    public string $description;
    public $petsitters;
    public array $prices = [15, 20, 25];
    public ?int $price = null;


    public function mount(): void
    {
        $this->animalTypes = AnimalType::all();
        $this->habitations = Habitation::all();
        $this->visitTypes = VisitType::all();
        $this->petsitters = User::where('is_petsitter', true)
            ->where('petsitter_status', PetsitterStatus::PENDING)
            ->get();

    }


    public function store(): void
    {
       $validated = $this->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'image' => 'image|nullable',
            'phone' => 'required|string',
            'adress' => 'required|string',
            'zip' => 'required|integer|max_digits:5',
            'location' => 'required|string',
            'habitation_id' => 'required|exists:habitations,id',
            'animals' => 'required|array',
            'visits' => 'required|array',
            'description' => 'nullable|string',
            'price'=>'nullable|integer',
        ]);

        if ($this->image) {

            $fileName = 'petsitter_' . uniqid() . '.jpg';

            $path = $this->image->storeAs(
                'petsitter/original',
                $fileName,
                's3'
            );

            ProcessImageJob::dispatchSync(
                $fileName,
                $path
            );

            $validated['image'] = $path;
        }

        $user = User::create([...$validated,
            'password' => Hash::make(Str::random(64)),
            'role' => null,
            'is_petsitter' => true,
            'petsitter_status' => PetsitterStatus::PENDING]);
        $user->animalTypes()->sync($this->animals);
        $user->visitTypes()->sync($this->visits);
        session()->flash('success', 'Demande envoyée avec succès');

        $this->reset([
            'last_name',
            'first_name',
            'phone',
            'email',
            'adress',
            'zip',
            'habitation_id',
            'animals',
            'visits',
            'image',
            'location',
            'description',
        ]);
    }
};
?>
<div>

    <section>
        <h1 class="text-text text-2xl font-bold uppercase text-center mt-20"> {{ __('petsitterCreateForm.title') }}</h1>
        <p class=" lg:w-1/2 text-center text-sm mx-auto"> {{ __('petsitterCreateForm.subtitle') }}</p>
        <form wire:submit="store" class="w-8/10 mx-auto mt-6">
            @csrf
            @if($image)
                <img class="h-40 w-40 object-cover rounded-2xl" src="{{ $image->temporaryUrl() }}"
                     alt="Prévisualisation">
            @endif
            <div>
                <x-forms.input-label type="file" name="image" label="{{ __('petsitterCreateForm.picture') }}"
                                     wire:model="image"/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="last_name" type="text" name="last_name"
                                     label="{{ __('form.last_name') }} " required/>
                <x-forms.input-label wire:model="first_name" type="text" name="first_name"
                                     label="{{ __('form.first_name') }} " required/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="email" type="email" name="email" label="{{ __('form.email') }} " required/>
                <x-forms.input-label wire:model="phone" type="text" name="phone" label="{{ __('form.phone') }} " required/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="adress" type="text" name="adress"
                                     label="{{ __('petsitterCreateForm.address') }} " required/>
                <x-forms.input-label wire:model="zip" type="number" name="zip"
                                     label=" {{ __('petsitterCreateForm.zip') }} " required/>
            </div>
            <div class="flex gap-6 justify-between">
                <x-forms.input-label wire:model="location" type="text" name="location"
                                     label="{{ __('petsitterCreateForm.location') }}" required/>
                <x-forms.select-option wire:model="price" name="prices" label="{{ __('petsitterCreateForm.price') }}">
                    <option value="">{{ __('petsitterCreateForm.price') }}</option>
                    @foreach($prices as $price)
                        <option value="{{ $price }}">
                            {{ $price }} €
                        </option>
                    @endforeach
                </x-forms.select-option>
            </div>
            <div>

            </div>
            <div class="flex flex-col lg:flex-row gap-12 justify-between">

                <div class="w-1/3">

                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        {{ __('petsitterCreateForm.habitation') }} <abbr title="Requis" class="no-underline text-red-500">*</abbr>
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($habitations as $habitation)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="radio"
                                    wire:model="habitation_id"
                                    name="home"
                                    value="{{ $habitation->id }}"
                                    class="w-4 h-4 accent-btn-green"
                                >

                                <span class="text-text">
                        {{ ucfirst( __( 'habitationType.' . $habitation->name )) }}
                    </span>

                            </label>

                        @endforeach

                    </div>

                </div>
                <div class="w-1/3">
                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        {{ __('petsitterCreateForm.chooseAnimal') }} <abbr title="Requis" class="no-underline text-red-500">*</abbr>
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($animalTypes as $type)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="checkbox"
                                    wire:model="animals"
                                    value="{{ $type->id }}"
                                    class="w-4 h-4 accent-btn-green"
                                >

                                <span class="text-text">
                        {{ ucfirst( __( 'animalTypes.' . $type->type)) }}
                    </span>

                            </label>

                        @endforeach

                    </div>
                </div>
                <div class="w-1/3">
                    <label class="block text-sm text-text uppercase font-bold mb-3">
                        {{ __('petsitterCreateForm.chooseVisit') }} <abbr title="Requis"  class="no-underline text-red-500">*</abbr>
                    </label>

                    <div class="flex flex-col gap-3">

                        @foreach($visitTypes as $visit)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input
                                    type="checkbox"
                                    wire:model="visits"
                                    value="{{ $visit->id }}"
                                    class="w-4 h-4 accent-btn-green"
                                >

                                <span class="text-text">
                        {{ ucfirst( __('visitTypes.' . $visit->name)) }}
                    </span>

                            </label>

                        @endforeach

                    </div>
                </div>
            </div>

            <div class="mt-6 mb-6">
                <x-forms.textarea-label
                    name="description"
                    wire:model="description"
                    label="{{ __('petsitterCreateForm.infos') }}"
                />
            </div>
            <div>
                <x-forms.button>
                    {{ __('formDaycare.candidate') }}
                </x-forms.button>
            </div>
        </form>
        <div class="w-1/2 mx-auto mb-6">
            @if( session('success'))
                <x-message_success/>
            @endif
        </div>
    </section>
</div>
