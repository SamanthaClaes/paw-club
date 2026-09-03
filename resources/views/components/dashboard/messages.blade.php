@props([
    'title',
    'messages',
    'showReadButton' => false,
])

<section class="mb-6 md:mt-30">
    <h2 class="text-xl mt-6 font-bold text-text dark:text-white md:text-2xl md:mt-20">
    {{ $title }}
    </h2>
</section>

<div class="overflow-hidden rounded-2xl border-2 border-stroke shadow-sm p-5 bg-card dark:bg-blue-950 dark:border-blue-800">


    <flux:table>

        <flux:table.columns>

            @if($showReadButton)
                <flux:table.column align="center">
                    Marquer comme lu
                </flux:table.column>
            @endif

            <flux:table.column align="center">
                Nom
            </flux:table.column>

            <flux:table.column align="center">
                Prénom
            </flux:table.column>

            <flux:table.column align="center">
                Email
            </flux:table.column>

            <flux:table.column align="center">
                Message
            </flux:table.column>

            <flux:table.column align="center">
                Actions
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>

            @forelse($messages as $message)

                <flux:table.row>

                    @if($showReadButton)

                        <flux:table.cell align="center">

                            <flux:button
                                size="sm"
                                class="cursor-pointer"
                                wire:click="markAsRead({{ $message->id }})"
                            >
                                Lu
                            </flux:button>

                        </flux:table.cell>

                    @endif

                    <flux:table.cell align="center" variant="strong">
                        {{ $message->last_name }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $message->first_name }}
                    </flux:table.cell>

                    <flux:table.cell align="center">
                        {{ $message->email }}
                    </flux:table.cell>

                    <flux:table.cell align="center" class="max-w-md">
                        {{ $message->message }}
                    </flux:table.cell>

                    <flux:table.cell align="center">

                        <div class="flex justify-center gap-2">

                            <x-table.mail-button :email="$message->email"/>

                            <flux:button
                                variant="danger"
                                size="sm"
                                class="cursor-pointer"
                                wire:click="deleteMessage({{ $message->id }})"
                                wire:confirm="Êtes-vous sûr de vouloir supprimer le message ?"
                            >
                                Supprimer
                            </flux:button>

                        </div>

                    </flux:table.cell>

                </flux:table.row>

            @empty

                <flux:table.row>

                    <flux:table.cell
                        colspan="{{ $showReadButton ? 6 : 5 }}"
                        class="text-center py-8"
                    >
                        Pas de message trouvé.
                    </flux:table.cell>

                </flux:table.row>

            @endforelse

        </flux:table.rows>

    </flux:table>

</div>
