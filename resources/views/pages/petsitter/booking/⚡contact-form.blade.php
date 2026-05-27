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
        <h1 class=" text-text text-2xl text-center font-bold mb-4 mt-4 lg:text-3xl lg:mt-20"> Vous allez envoyer un
            message à {{ $user->first_name }} {{ $user->last_name }} </h1>

        <form wire:submit="store" class="w-8/10 mx-auto">
            <div class="flex gap-6">
                <x-forms.input-label wire:model="first_name" name="first_name" label="Prénom" type="text" required/>
                <x-forms.input-label wire:model="last_name" name="last_name" label="Nom" type="text" required/>
            </div>
            <div class="flex gap-6">
                <x-forms.input-label wire:model="email" name="email" label="Email" type="email" required/>
                <x-forms.input-label wire:model="phone" name="phone" label="Téléphone" type="text"/>
            </div>
            <div>
                <label class="text-text font-bold uppercase" for="message">Votre message</label>
                <textarea wire:model="message" name="message" id="message" cols="30" rows="10"
                          class="w-full border-2 border-element rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-background resize-none"></textarea>
            </div>
            <div>
                <x-forms.button>
                    Envoyer votre message
                </x-forms.button>
            </div>

        </form>
        @if( session('success'))
            <x-message_success/>
        @endif
   </section>
</div>
