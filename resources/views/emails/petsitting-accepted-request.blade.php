@extends('layouts.mail')

@section('content')

    <section>

        ```
        <h1>
            Bonjour {{ $owner->first_name }},
        </h1>

        <p>
            Bonne nouvelle ! 🎉
        </p>

        <p>
            Votre demande de garde pour {{ $pet->name }} a été acceptée par {{ $petsitter->first_name }}.
        </p>

        <div class="card">

            <h2>
                Récapitulatif de la garde
            </h2>

            <p>
                <span class="label">Petsitter :</span>
                {{ $petsitter->first_name }} {{ $petsitter->last_name }}
            </p>

            <p>
                <span class="label">Animal :</span>
                {{ $pet->name }}
            </p>

            <p>
                <span class="label">Début :</span>
                {{ $request->start_date->format('d/m/Y') }}
            </p>

            <p>
                <span class="label">Fin :</span>
                {{ $request->end_date->format('d/m/Y') }}
            </p>

        </div>

        <p style="margin-top:30px;">
            Votre réservation est désormais confirmée. Nous vous souhaitons une excellente expérience avec votre petsitter.
        </p>

        <p>
            Merci de votre confiance,
            L'équipe Puppy Club 🐾
        </p>

    </section>

@endsection
