<?php

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Liste de messages'])]
class extends Component {

    public $unreadMessages;
    public $readMessages;

    public function mount()
    {
        $this->loadMessages();
    }

    public function deleteMessage($messageId): void
    {
        $message = ContactMessage::findOrFail($messageId)->delete();
        $this->loadMessages();
    }

    public function markAsRead($messageId): void
    {
        $message = ContactMessage::findOrFail($messageId);
        $message->is_read = true;
        $message->save();
        $this->loadMessages();
    }


    public function loadMessages(): void
    {
        $this->unreadMessages = ContactMessage::where('is_read', false)->latest()->get();
        $this->readMessages = ContactMessage::where('is_read', true)->latest()->get();
    }
};
?>

<div>
    <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
        <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des messages non lus</h2>
    </section>
    <div class="ml-25">
        <table class="min-w-full border dark:border-none">
            <thead class="bg-element">
            <tr class="bg-background border-b">
                <th class="border-r">Marquer comme lu</th>
                <th class="border-r">Nom</th>
                <th class="border-r">Prénom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Message</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($unreadMessages as $message)
                <tr>
                    <x-table.table-data>
                        <button class="cursor-pointer" wire:click="markAsRead({{ $message->id }})"> lu</button>
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $message->last_name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{  $message->first_name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $message->email }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $message->message }}
                    </x-table.table-data>
                    <x-table.table-data>
                        <div class="flex gap-2 justify-center">
                            <div>
                                <x-table.mail-button :email="$message->email"/>
                            </div>
                            <div>
                                <x-table.delete-button wire:confirm="Etes vous sur de vouloir supprimer le message ? "
                                                       wire:click="deleteMessage($message->id)"/>
                            </div>
                        </div>
                    </x-table.table-data>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="bg-white p-3">Pas de message trouvés</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div>
        <section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">
            <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">Liste des messages lus</h2>
        </section>
        <div class="ml-25">
            <table class="min-w-full border dark:border-none">
                <thead class="bg-element">
                <tr class="bg-background border-b">
                    <th class="border-r">Nom</th>
                    <th class="border-r">Prénom</th>
                    <th class="border-r">Email</th>
                    <th class="border-r">Message</th>
                    <th class="border-r">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($readMessages as $message)
                    <tr>
                        <x-table.table-data>
                            {{ $message->last_name }}
                        </x-table.table-data>
                        <x-table.table-data>
                            {{  $message->first_name }}
                        </x-table.table-data>
                        <x-table.table-data>
                            {{ $message->email }}
                        </x-table.table-data>
                        <x-table.table-data>
                            {{ $message->message }}
                        </x-table.table-data>
                        <x-table.table-data>
                            <div class="flex gap-2 justify-center">
                                <div>
                                    <x-table.mail-button :email="$message->email"/>
                                </div>
                                <div>
                                    <x-table.delete-button
                                        wire:confirm="Etes vous sur de vouloir supprimer le message ? "
                                        wire:click="deleteMessage($message->id)"/>
                                </div>
                            </div>
                        </x-table.table-data>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="bg-white p-3">Pas de message trouvés</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
    </div>
</div>
</div>
