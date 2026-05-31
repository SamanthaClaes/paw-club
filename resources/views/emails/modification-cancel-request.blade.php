@extends('layouts.mail')

@section('content')

    <h1>
        Demande de modification annulée
    </h1>

    <p>
        La demande de modification a été annulée.
    </p>

    <div class="card">

        <p>
            Les dates initialement acceptées restent inchangées.
        </p>

        <p>
            La garde est toujours confirmée.
        </p>

        <p>
            <span class="label">Période :</span>
            {{ \Carbon\Carbon::parse($request->start_date)->format('d/m/Y') }}
            →
            {{ \Carbon\Carbon::parse($request->end_date)->format('d/m/Y') }}
        </p>

    </div>

    <p>
        Vous pouvez consulter la demande depuis votre espace PawClub.
    </p>

    <p>
        <a href="{{ route('petsitter.requests') }}">
            Voir la demande
        </a>
    </p>

@endsection
