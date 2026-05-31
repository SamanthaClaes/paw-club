@extends('layouts.mail')

@section('content')

    <h1>
        Demande de modification refusée
    </h1>

    <p>
        Votre demande de modification n'a pas été acceptée.
    </p>

    <div class="card">

        <p>
            Les nouvelles dates proposées ont été refusées.
        </p>

        <p>
            La demande de garde est de nouveau en attente de votre décision.
        </p>

    </div>

    <p>
        Vous pouvez consulter la demande depuis votre espace PawClub.
    </p>

    <p>
        <a href="{{ route('petsitter.request') }}">
            Voir la demande
        </a>
    </p>

@endsection
