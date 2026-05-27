@props([
    'title',
    'messages',
    'showReadButton' => false,
])

<section class="md:ml-25 mb-6 md:mt-30 text-text text-2xl uppercase font-bold">

    <h2 class="text-xl mt-6 font-bold text-text md:text-2xl md:mt-0 dark:text-white">
        {{ $title }}
    </h2>

</section>

<div>

    <table class="min-w-full border dark:border-none">

        <thead class="bg-element">

        <tr class="bg-background border-b">

            @if($showReadButton)
                <th class="border-r">
                    Marquer comme lu
                </th>
            @endif

            <th class="border-r">Nom</th>

            <th class="border-r">Prénom</th>

            <th class="border-r">Email</th>

            <th class="border-r">Message</th>

            <th class="border-r">Actions</th>

        </tr>

        </thead>

        <tbody>

        @forelse($messages as $message)

            <tr>

                @if($showReadButton)

                    <x-table.table-data>

                        <button
                            class="cursor-pointer"
                            wire:click="markAsRead({{ $message->id }})"
                        >
                            Lu
                        </button>

                    </x-table.table-data>

                @endif

                <x-table.table-data>
                    {{ $message->last_name }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $message->first_name }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $message->email }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $message->message }}
                </x-table.table-data>

                <x-table.table-data>

                    <div class="flex gap-2 justify-center">

                        <x-table.mail-button :email="$message->email"/>

                        <x-table.delete-button
                            wire:confirm="Etes vous sur de vouloir supprimer le message ?"
                            wire:click="deleteMessage({{ $message->id }})"
                        />

                    </div>

                </x-table.table-data>

            </tr>

        @empty

            <tr>

                <td colspan="{{ $showReadButton ? 6 : 5 }}"
                    class="bg-white p-3"
                >
                    Pas de message trouvés
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>
