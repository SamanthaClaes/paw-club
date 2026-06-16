@php use Carbon\Carbon; @endphp
@extends('layouts.mail')

@section('content')

    <section>

        <h1>
            Bonjour {{ $petsitter->first_name }},
        </h1>

        <p>
            Vous avez reçu une nouvelle demande de garde sur Puppy Club 🐾
        </p>

        <div class="card">

            <h2>
                Informations de la demande
            </h2>

            <p>
                <span class="label">Propriétaire :</span>
                {{ $owner->first_name }} {{ $owner->last_name }}
            </p>

            <p>
                <span class="label">Animal :</span>
                {{ $pet->name }} - {{ $pet->breed->name }}
            </p>

            <p>
                <span class="label">Dates :</span>
                Du {{ Carbon::parse($petsittingRequest->start_date)->format('d/m/Y') }}
                au {{ Carbon::parse($petsittingRequest->end_date)->format('d/m/Y') }}
            </p>

        </div>

        <div style="text-align:center; margin:35px 0;">

            <a
                href="{{ route('petsitter.request', ['locale' => app()->getLocale()]) }}"
                style="
            display:inline-block;
            background:#50C878;
            color:#ffffff;
            text-decoration:none;
            padding:14px 28px;
            border-radius:12px;
            font-weight:bold;
            text-transform:uppercase;
        "
            >
                Voir la demande
            </a>

        </div>

        <p>
            Connectez-vous à votre espace petsitter pour consulter les informations complètes et répondre à cette
            demande.
        </p>

        <p>
            Merci de faire partie de la communauté Puppy Club
        </p>

    </section>

@endsection
