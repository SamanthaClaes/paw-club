@extends('layouts.mail')

@section('content')

    <section>
        <h1>
            Bonjour {{ $petsitter->first_name }}
        </h1>

        <p>
            Votre demande petsitter n'a malheureusement pas pu être acceptée
        </p>

        <div class="card">

            <h2>
                Pourquoi?
            </h2>

            <p>
                Votre profil ne correspondait pas à ce que nous recherchions pour le moment.
                Rien ne vous empêche de réessayer plus tard.
            </p>

            <p>Merci d’avoir choisi Paw club</p>
        </div>
    </section>

@endsection
