<?php

use App\Enums\PetsitterRequestStatus;
use App\Models\AnimalType;
use App\Models\PetsitterMessages;
use App\Models\PetSittingRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Mon profil')]
class extends Component {

    use WithFileUploads;

    public User $petsitter;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $types = [];
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $adress = '';
    public string $phone = '';
    public string $location = '';
    public string $zip = '';
    public $image;

    public function mount(): void
    {
        $this->petsitter = Auth::user();
        $this->types = AnimalType::all();
        $this->first_name = $this->petsitter->first_name;
        $this->last_name = $this->petsitter->last_name;
        $this->email = $this->petsitter->email;
        $this->adress = $this->petsitter->adress;
        $this->phone = $this->petsitter->phone;
        $this->location = $this->petsitter->location;
        $this->zip = $this->petsitter->zip;

    }

    public function store(): void
    {
        PetSittingRequest::with([
            'user',
            'pet',
            'pet.breed',
            'pet.animalType'
        ])
            ->where('petsitter_id', Auth::id())->get();
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
            'image' => 'nullable|image',
        ]);
        if ($this->image) {
            $validated['image'] = $this->image->store('petsitter', 'public');
        }

        $this->petsitter->update($validated);
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

    #[Computed]
    public function countRequestPending(): int
    {
        return PetSittingRequest::where('status', PetsitterRequestStatus::PENDING)->count();
    }

    #[Computed]
    public function countRequestAccepted(): int
    {
        return PetSittingRequest::where('status', PetsitterRequestStatus::ACCEPTED)->count();
    }

    #[Computed]
    public function countRequestRefused(): int
    {
        return PetSittingRequest::where('status', PetsitterRequestStatus::REFUSED)->count();
    }

    #[Computed]
    public function unreadMessageCount(): int
    {
        return PetsitterMessages::where('is_read', false)->count();
    }
};
?>
<section class="max-w-7xl mx-auto px-6">
    <h1 class=" text-text text-2xl text-center font-bold mb-4 lg:text-3xl mt-20 uppercase">Mes informations</h1>
    <x-header.PetsitterNav/>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-16">
        <div>
            <x-cards.dashboard_card
                title="Messages non lus"
                :number="$this->unreadMessageCount"
                route="{{ route('petsitter.messages') }}"
                class="bg-element"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title="Demandes en attente"
                :number="$this->countRequestPending"
                route="{{ route('petsitter.request') }}#pending"
                class="bg-yellow-100"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title="Demandes acceptées"
                :number="$this->countRequestAccepted"
                route="{{ route('petsitter.request') }}#accepted"
                class="bg-green-100"
            />
        </div>
        <div>
            <x-cards.dashboard_card
                title="Demandes refusées"
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
            :image="$petsitter->image"
        />

        <x-cards.ps_card_profile_info
            :type="$petsitter->animalTypes->pluck('type')->join(', ')"
            :visit="$petsitter->visitTypes->pluck('name')->join(', ')"

        />
    </div>
</section>
