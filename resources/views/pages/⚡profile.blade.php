<?php

use App\Enums\PetsitterRequestStatus;
use App\Jobs\ProcessImageJob;
use App\Models\AnimalType;
use App\Models\PetsitterMessages;
use App\Models\PetSittingRequest;
use App\Models\VisitType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

new  #[Title('Mon profil | Paw-club')]
class extends Component {

    use WithFileUploads;

    public User $user;
    public string $email;
    public ?string $adress;
    public ?string $phone = null;
    public $image;
    public ?string $currentImage = null;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';
    public array $animalTypes = [];
    public array $visitTypes = [];
    public Collection $animalTypesList;
    public Collection $visitTypesList;
    public array $prices = [15, 20, 25];
    public ?int $price = null;


    public function mount(): void
    {
        $this->user = Auth::user();
        $this->email = $this->user->email;
        $this->adress = $this->user->adress;
        $this->phone = $this->user->phone;
        $this->currentImage = $this->user->image;
        $this->animalTypesList = AnimalType::all();
        $this->visitTypesList = VisitType::all();
        $this->price = $this->user->price;

    }

    #[On('open-update-infos')]
    public function loadInfos(): void
    {
        if (!$this->user->is_petsitter) {
            return;
        }

        $this->animalTypes = $this->user
            ->animalTypes
            ->pluck('id')
            ->toArray();

        $this->visitTypes = $this->user
            ->visitTypes
            ->pluck('id')
            ->toArray();
    }

    public function updateInfos(): void
    {
        if (!$this->user->is_petsitter) {
            return;
        }

        $this->validate([
            'animalTypes' => ['array'],
            'visitTypes' => ['array'],
            'price' => ['required', 'integer'],
        ]);

        $this->user->animalTypes()->sync($this->animalTypes);
        $this->user->visitTypes()->sync($this->visitTypes);
        $this->user->update([
            'price' => $this->price,
        ]);
        $this->user->refresh();
        $this->dispatch('update-infos');

    }

    #[Computed]
    public function countRequestPending(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->user->id)
            ->where('status', PetsitterRequestStatus::PENDING)
            ->count();
    }

    #[Computed]
    public function countRequestAccepted(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->user->id)
            ->where('status', PetsitterRequestStatus::ACCEPTED)
            ->count();
    }

    #[Computed]
    public function countRequestRefused(): int
    {
        return PetSittingRequest::where('petsitter_id', $this->user->id)
            ->where('status', PetsitterRequestStatus::REFUSED)
            ->count();
    }

    #[Computed]
    public function unreadMessageCount(): int
    {
        return PetsitterMessages::where('petsitter_id', $this->user->id)
            ->where('is_read', false)
            ->count();
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

public function updateData(): void
{
    $validated = $this->validate([
        'email' => 'required|email',
        'image' => 'image|nullable|mimes:jpg,jpeg,webp|max:10240',
        'adress' => 'required|string',
        'phone' => 'nullable',
    ]);

    if ($this->image) {

        $fileName = 'user_' . uniqid() . '.jpg';

        $path = $this->image->storeAs(
            'user/original',
            $fileName,
            's3'
        );

        ProcessImageJob::dispatchSync(
            $fileName,
            $path
        );

        $validated['image'] = $path;
    }

    $this->user->update($validated);
    $this->user->refresh();

    $this->dispatch('update-data');
}

};


?>

<div class="max-w-5xl mx-auto mt-20 mb-30">
    <x-header.UserNav/>
    @if($user->is_petsitter)
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mt-16 mb-20">
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
    @endif
    <x-cards.user_profile_card
        :user="$user"
    />
    <section class="max-w-7xl mx-auto mt-30">
        <div class="flex flex-col gap-3 ml-3 md:flex-row justify-between items-start md:items-center mb-4">
            <h2 class="text-text lg:text-2xl text-lg uppercase font-bold">{{ __('ownerProfile.title') }}</h2>
           <x-cta.add title="{{ __('ownerProfile.add') }}"
                       class="bg-btn-green hover:bg-hover-green text-cta hover:text-white"/>
        </div>
        <livewire:pages::pets.create/>
        <livewire:pages::pets.edit/>
    </section>
</div>
