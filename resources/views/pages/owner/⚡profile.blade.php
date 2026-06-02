<?php

use App\Jobs\ProcessImageJob;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

new  #[Title('Mon profil')]
class extends Component {

    use WithFileUploads;

    public User $owner;
    public string $email;
    public string $adress;
    public ?string $phone = null;
    public $image;
    public ?string $currentImage = null;
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';



    public function mount(): void
    {
        $this->owner = Auth::user();
        $this->email = $this->owner->email;
        $this->adress = $this->owner->adress;
        $this->phone = $this->owner->phone;
        $this->currentImage = $this->owner->image;

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
            'image' => 'nullable|image',
            'adress' => 'required|string',
            'phone' => 'nullable',
        ]);

        if($this->image){

        $fileName = 'owner_' . uniqid() . '.jpg';

        $path = $this->image->storeAs(
            'owner/original',
            $fileName,
            's3'
        );

            ProcessImageJob::dispatchSync(
                $fileName,
                $path
            );

        $validated['image'] = $path;
    }

        $this->owner->update($validated);
        $this->owner->refresh();

        $this->dispatch('update-data');
    }
};


?>

<div class="max-w-5xl mx-auto mt-20 mb-30">
    <x-header.OwnerNav/>

    <x-cards.owner_card_profile
        :first_name="$owner->first_name"
        :last_name="$owner->last_name"
        :email="$email"
        :adress="$adress"
        :location="$owner->location"
        :zip="$owner->zip"
        :phone="$phone"
        :image="$owner->image"
        :owner="$owner"
    />
    <section class="max-w-7xl mx-auto mt-30">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
            <h2 class="text-text lg:text-2xl text-lg uppercase font-bold">{{ __('ownerProfile.title') }}</h2>
            <x-cta.add title="{{ __('ownerProfile.add') }}" class="bg-btn-green hover:bg-hover-green text-cta hover:text-white" />
        </div>
        <livewire:pages::owner.pets.create/>
        <livewire:pages::owner.pets.edit/>
    </section>
</div>
