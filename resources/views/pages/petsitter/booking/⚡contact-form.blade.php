<?php

use App\Mail\PetsitterMessageMail;
use App\Models\PetsitterMessages;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Contacter le petsitter')]
class extends Component {
    public User $user;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public ?string $phone = null;
    public string $message = '';


    public function mount(User $user): void
    {
        if (Auth::check()) {

            $this->first_name = Auth::user()->first_name;

            $this->last_name = Auth::user()->last_name;

            $this->email = Auth::user()->email;

            $this->phone = Auth::user()->phone;
        }
    }

    public function store(): void
    {
        $validated = $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        PetsitterMessages::create([...$validated, 'petsitter_id' => $this->user->id, 'is_read' => false]);
        Mail::to($this->user->email)->queue(new PetsitterMessageMail($this->user, $validated));
        session()->flash('success', 'Message envoyé avec succès');
        $this->reset([
            'first_name',
            'last_name',
            'email',
            'phone',
            'message',
        ]);
    }
};
?>

<div>
    <section>
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20"> {{ __('petsitterContact.title') }} {{ $user->first_name }} {{ $user->last_name }} </h1>
        <div class="flex flex-col items-center gap-3 text-text">

            <h2 class="font-bold text-lg">
              {{ __('petsitterContact.coordonates') }}
            </h2>

            <div class="flex flex-col items-center">
                <span><strong> {{ __('petsitterContact.firstName') }} :</strong> {{ $first_name }}</span>
                <span><strong> {{ __('petsitterContact.lastName') }} :</strong> {{ $last_name }}</span>
            </div>

            <div class="flex flex-col items-center">
                <span><strong> {{ __('petsitterContact.email') }} :</strong> {{ $email }}</span>
                <span><strong>{{ __('petsitterContact.phone') }} :</strong> {{ $phone }}</span>
            </div>

        </div>

        <form wire:submit="store" class="w-8/10 mx-auto">
            <div class="flex gap-6" hidden>
                <x-forms.input-label wire:model="first_name" name="first_name" label="Prénom" type="text" required/>
                <x-forms.input-label wire:model="last_name" name="last_name" label="Nom" type="text" required/>
            </div>
            <div class="flex gap-6" hidden>
                <x-forms.input-label wire:model="email" name="email" label="Email" type="email" required/>
                <x-forms.input-label wire:model="phone" name="phone" label="Téléphone" type="text"/>
            </div>
            <div>
                <x-forms.textarea-label
                    name="message"
                    wire:model="message"
                    label="{{ __('form.message') }}"
                />
            </div>
            <div>
                <x-forms.button>
                    {{ __('petsitterContact.sent') }}
                </x-forms.button>
            </div>

        </form>
        <div class="w-1/2 mx-auto">
            @if( session('success'))
                <x-message_success/>
            @endif
        </div>
    </section>
</div>
