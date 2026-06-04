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
                Activez votre compte
            </h2>

            <p>
                Pour sécuriser votre compte, cliquez sur le bouton ci-dessous afin de définir votre mot de passe.
            </p>

            <a href="{{ route('password.reset', [
    'token' => $token,
    'email' => $petsitter->email,
]) }}">
                Définir mon mot de passe
            </a>

        </div>

        <p style="margin-top:30px;">
            Une fois votre mot de passe défini, vous pourrez vous connecter à votre espace Paw Club.
        </p>

    </section>

@endsection
