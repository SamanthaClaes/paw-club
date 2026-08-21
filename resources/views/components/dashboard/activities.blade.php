@props([
    'activities'
])

@php
    use App\Enums\ActivityType;
@endphp

<div class="md:ml-25 mt-10 mb-10">

    <h2 class="text-2xl font-bold text-text dark:text-white mb-6">
        Dernières activités
    </h2>

    <div class="rounded-2xl border-2 border-stroke bg-card dark:bg-slate-800 dark:border-slate-600 p-6">

        @forelse($activities as $activity)

            <div class="flex items-center justify-between gap-4 py-4 border-b border-gray-200 dark:border-slate-600 last:border-b-0">

                <div class="flex items-center gap-3">

                    @if($activity->action === ActivityType::DAYCARE_REQUEST_CREATED)

                        <span class="text-xl">📅</span>

                        <span>
                            Nouvelle demande de garderie pour
                            <strong>{{ $activity->pet?->name }}</strong>.
                        </span>

                    @elseif($activity->action === ActivityType::DAYCARE_REQUEST_ACCEPTED)

                        <span class="text-xl">✔️</span>

                        <span>
                            <strong>{{ $activity->pet?->name }}</strong>
                            vient d'être accepté à la garderie.
                        </span>

                    @elseif($activity->action === ActivityType::DAYCARE_REQUEST_REFUSED)

                        <span class="text-xl">❌</span>

                        <span>
                            La demande de garderie pour
                            <strong>{{ $activity->pet?->name }}</strong>
                            a été refusée.
                        </span>

                    @endif

                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                    {{ $activity->created_at->locale('fr')->diffForHumans() }}
                </div>

            </div>

        @empty

            <p class="text-gray-500 dark:text-gray-300">
                Aucune activité récente.
            </p>

        @endforelse

    </div>

</div>
