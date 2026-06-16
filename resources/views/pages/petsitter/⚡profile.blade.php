<?php

use App\Enums\PetsitterRequestStatus;
use App\Jobs\ProcessImageJob;
use App\Models\AnimalType;
use App\Models\PetsitterMessages;
use App\Models\PetSittingRequest;
use App\Models\User;
use App\Models\VisitType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Mon profil | Paw-club')]
class extends Component {

    use WithFileUploads;

    public User $petsitter;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $adress = '';
    public ?string $phone = null;
    public string $location = '';
    public string $zip = '';
    public $image = null;
    public array $animalTypes = [];
    public array $visitTypes = [];
    public Collection $animalTypesList;
    public Collection $visitTypesList;
    public array $prices = [15, 20, 25];
    public ?int $price = null;


    public function mount(): void
    {

        $this->petsitter = Auth::user();
        $this->first_name = $this->petsitter->first_name;
        $this->last_name = $this->petsitter->last_name;
        $this->email = $this->petsitter->email;
        $this->adress = $this->petsitter->adress;
        $this->phone = $this->petsitter->phone;
        $this->location = $this->petsitter->location;
        $this->zip = $this->petsitter->zip;
        $this->animalTypesList = AnimalType::all();
        $this->visitTypesList = VisitType::all();
        $this->price = $this->petsitter->price;

    }

    #[On('open-update-infos')]
    public function loadInfos(): void
    {
        $this->animalTypes = $this->petsitter
            ->animalTypes
            ->pluck('id')
            ->toArray();

        $this->visitTypes = $this->petsitter
            ->visitTypes
            ->pluck('id')
            ->toArray();
    }

    public function updateData(): void
    {
        $validated = $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'adress' => 'required|string',
            'phone' => 'nullable|string',
            'location' => 'required|string',
            'zip' => 'required',
            'image' => 'image|nullable|max:10240',
        ]);
        if ($this->image) {
            $fileName = 'petsitter_' . uniqid() . '.jpg';
            $path = $this->image->storeAs(
                'petsitter/original',
                $fileName,
                's3'
            );
            ProcessImageJob::dispatchSync($fileName, $path);
            $validated['image'] = $path;
        }
        $this->petsitter->update($validated);
        $this->petsitter->refresh();
        $this->reset('image');
        $this->dispatch('update-data');
        session()->flash('success', 'Informations mises à jour');
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

    public function updateInfos(): void
    {
        $this->validate([
            'animalTypes' => ['array'],
            'visitTypes' => ['array'],
            'price' => ['required', 'integer'],
        ]);

        $this->petsitter->animalTypes()->sync($this->animalTypes);
        $this->petsitter->visitTypes()->sync($this->visitTypes);
        $this->petsitter->update([
            'price' => $this->price,
        ]);
        $this->petsitter->refresh();
        $this->dispatch('update-infos');

    }


    #[Computed]
    public function countRequestPending(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->petsitter->id)
            ->where('status', PetsitterRequestStatus::PENDING)
            ->count();
    }

    #[Computed]
    public function countRequestAccepted(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->petsitter->id)
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->count();
    }

    #[Computed]
    public function countRequestRefused(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->petsitter->id)
            ->where('status', PetsitterRequestStatus::REFUSED)
            ->count();
    }

    #[Computed]
    public function unreadMessageCount(): int
    {
        return PetsitterMessages::where('petsitter_id', $this->petsitter->id)
            ->where('is_read', false)
            ->count();
    }
};
?>
<section class="max-w-7xl mx-auto px-6" itemscope
         itemtype="https://schema.org/Person">
    <h1 class=" text-text text-2xl text-center font-bold mb-4 lg:text-3xl mt-20 uppercase">{{ __('ownerProfile.informations') }}</h1>
    <x-header.PetsitterNav/>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-16">
        <div>
            <x-cards.dashboard_card
                title="{{ trans_choice('profileCard.unreadMessages', $this->unreadMessageCount) }}"
                :number="$this->unreadMessageCount"
                route="{{ route('petsitter.messages') }}"
                class="bg-element"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title=" {{ trans_choice('profileCard.pendingRequest', $this->countRequestPending) }}"
                :number="$this->countRequestPending"
                route="{{ route('petsitter.request') }}#pending"
                class="bg-yellow-100"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title="{{ trans_choice('profileCard.acceptedRequest', $this->countRequestAccepted) }}"
                :number="$this->countRequestAccepted"
                route="{{ route('petsitter.request') }}#accepted"
                class="bg-green-100"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title="{{ trans_choice('profileCard.refusedRequest', $this->countRequestRefused) }}"
                :number="$this->countRequestRefused"
                route="{{ route('petsitter.request') }}#refused"
                class="bg-red-100"
            />
        </div>
    </div>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-10 mt-20 mb-20 items-start">
        <x-cards.ps_card_profile
            :last_name="$petsitter->last_name"
            :first_name="$petsitter->first_name"
            :email="$petsitter->email"
            :phone="$petsitter->phone"
            :adress="$petsitter->adress"
            :zip="$petsitter->zip"
            :location="$petsitter->location"
            :petsitter="$petsitter"
        />

        <x-cards.ps_card_profile_info
            :type="$petsitter->animalTypes
    ->map(fn ($animalType) => __('animalTypes.' . $animalType->type))
    ->join(', ')"
            :visit="$petsitter->visitTypes
    ->map(fn ($visitType) => __('visitTypes.' . $visitType->name))
    ->join(', ')"
            :animal-types-list="$animalTypesList"
            :visit-types-list="$visitTypesList"
            :price="$petsitter->price"

        />

    </div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
        <h2 class="text-text lg:text-2xl text-lg uppercase font-bold">{{ __('ownerProfile.title') }}</h2>
        <x-cta.add title="{{ __('ownerProfile.add') }} "
                   class="bg-btn-green hover:bg-hover-green text-cta hover:text-white"/>
    </div>
    <livewire:pages::owner.pets.create/>
    <livewire:pages::owner.pets.edit/>

</section>
