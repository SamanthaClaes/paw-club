<?php

use App\Models\PetsitterMessages;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

new #[Title('Mes messages | Paw-club')]
class extends Component {
    public $messages;

    public function mount(): void
    {
        $this->loadMessages();
    }

    public function deleteMessage($messageId): void
    {
        $message = PetsitterMessages::where('petsitter_id', Auth::id())
            ->findOrFail($messageId);

        $message->delete();
        $this->loadMessages();
    }

    public function markAsRead($messageId): void
    {
        $message = PetsitterMessages::where('petsitter_id', Auth::id())
            ->findOrFail($messageId);
        $message->is_read = true;
        $message->save();
        $this->loadMessages();
    }

    public function loadMessages(): void
    {
        $this->messages = PetsitterMessages::where('petsitter_id', Auth::id())
            ->latest()
            ->get();
    }

};
?>

<div>
    <div class="pb-20">
        <x-header.UserNav/>
        <section class="mt-10 max-w-7xl mx-auto">

            <div class="mb-12">

                <h1 class="text-3xl font-extrabold uppercase text-text mb-6">
                    Mes messages
                </h1>

                <p class="text-text mb-6">
                    Retrouvez ici les messages envoyés par les propriétaires.
                </p>

            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

                @forelse($messages as $message)

                    <div class="border rounded-3xl p-6 transition-all duration-300
                    {{ $message->is_read ? 'bg-gray-50 border-gray-200 opacity-80' : 'bg-card border-stroke shadow-sm' }}
                    ">

                        <div class="flex justify-between items-start mb-5">

                            <div>

                                <h2 class="text-xl font-bold text-text">
                                    {{ $message->first_name }}
                                    {{ $message->last_name }}
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $message->email }}
                                </p>

                            </div>

                            <div class="flex items-center gap-2">
                                @if($message->is_read)
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                     Lu
                                     </span>
                                @else
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                     Non lu
                                    </span>
                                @endif

                                <button
                                    wire:click="deleteMessage({{ $message->id }})"
                                    class="p-2 text-red-500 rounded-lg transition"
                                    title="Supprimer"
                                >
                                    <img src="{{ asset('svg/delete.svg') }}" alt="Supprimer" class="w-5 h-5">
                                </button>
                            </div>
                        </div>

                        <div class="bg-background border border-element rounded-2xl p-4 mb-6">

                            <p class="text-text leading-7">
                                {{ $message->message }}
                            </p>

                        </div>

                        <div class="flex gap-3">

                            @if(!$message->is_read)

                                <button
                                    class="flex-1 bg-btn-green hover:bg-green-700 text-white rounded-xl py-3 font-bold transition "
                                    wire:click="markAsRead({{ $message->id }})">
                                    Marquer comme lu
                                </button>

                            @endif
                            <a
                                href="mailto:{{ $message->email }}"
                                class="flex-1 bg-blue-400 hover:bg-blue-500 text-white rounded-xl py-3 font-bold transition text-center"
                            >
                                Répondre
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="bg-card border border-element rounded-3xl p-8">

                        <p class="text-center text-text font-semibold">
                            Vous n’avez encore reçu aucun message.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>

    </div>
</div>
