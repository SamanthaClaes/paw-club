<?php

use App\Models\ContactMessage;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::dashboard', ['title' => 'Liste de messages'])]
class extends Component {

    public $unreadMessages;
    public $readMessages;

    public function mount(): void
    {
        $this->loadMessages();
    }

    public function deleteMessage($messageId): void
    {
        $message = ContactMessage::findOrFail($messageId);

        $message->delete();
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
    <div class="ml-25">
        <x-dashboard.messages
            title="Liste des messages non lus"
            :messages="$unreadMessages"
            :show-read-button="true"
        />
        <x-dashboard.messages
            title="Liste des messages lus"
            :messages="$readMessages"
        />
    </div>
</div>

