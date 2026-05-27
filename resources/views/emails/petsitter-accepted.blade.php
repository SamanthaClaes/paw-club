@extends('layouts.mail')

@section('content')

    <section>
        <h1>
            Bonjour {{ $petsitter->first_name }}
        </h1>

        <p>
            Votre demande petsitter a bien été acceptée 🎉
        </p>

        <p>
            Vous pouvez désormais accéder à votre espace PawClub et commencer à recevoir des demandes de garde.
        </p>

        <div class="card">

            <h2>
                Vos identifiants
            </h2>

            <p>
                <span class="label">Email :</span>
                {{ $petsitter->email }}
            </p>

            <p>
                <span class="label">Mot de passe :</span>
                password
            </p>

        </div>

        <p style="margin-top:30px;">
            Pour des raisons de sécurité, nous vous recommandons de modifier votre mot de passe dès votre première connexion.
        </p>
        ```

    </section>

@endsection
