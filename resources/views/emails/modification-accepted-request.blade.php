@extends('layouts.mail')

@section('content')

    <h1>
        Demande de modification acceptée
    </h1>

    <p>
        Votre demande de modification de garde a été acceptée.
    </p>

    <div class="card">

        <p>
            Les nouvelles dates proposées ont été validées.
        </p>

        <p>
            <span class="label">Nouvelle période :</span>
            {{ $request->start_date->format('d/m/Y') }}
            →
            {{ $request->end_date->format('d/m/Y') }}
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
