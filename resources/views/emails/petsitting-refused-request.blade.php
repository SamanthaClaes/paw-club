@php use Carbon\Carbon; @endphp
@extends('layouts.mail')

@section('content')

    <section>
        <h1>
            Bonjour {{ $owner->first_name }},
        </h1>

        <p>
            Nous sommes désolés de vous informer que votre demande de garde pour <strong>{{ $pet->name }}</strong> a été
            refusée par <strong>{{ $petsitter->first_name }}</strong>.
        </p>

        <div class="card">

            <h2>
                Récapitulatif de la demande
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
                <span class="label">Dates :</span>
                Du {{ Carbon::parse($petsittingRequest->start_date)->format('d/m/Y') }}
                au {{ Carbon::parse($petsittingRequest->end_date)->format('d/m/Y') }}
            </p>

        </div>

        <p style="margin-top:30px;">
            Pas d'inquiétude, de nombreux autres petsitters sont disponibles sur Puppy Club et pourront peut-être
            répondre à votre besoin.
        </p>

        <div style="text-align:center; margin:35px 0;">

            <a
                href="{{ route('petsitter.index') }}"
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
                Trouver un autre petsitter
            </a>

        </div>

        <p>
            Merci de votre confiance,<br>
            L'équipe Puppy Club 🐾
        </p>

    </section>

@endsection
