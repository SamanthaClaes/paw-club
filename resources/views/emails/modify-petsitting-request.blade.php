@php use Carbon\Carbon; @endphp
@extends( 'layouts.mail')

@section( 'content')

    <h1>
        Demande de modification de garde
    </h1>

    <p>
        Votre petsitter a proposé une modification concernant la garde de
        {{ $petSittingRequest->pet->name }}.
    </p>

    <div class="card">

        <p>
            <span class="label">Dates actuellement prévues :</span><br>
            Du {{ Carbon::parse($petSittingRequest->start_date)->format('d/m/Y') }}
            au {{ Carbon::parse($petSittingRequest->end_date)->format('d/m/Y') }}
        </p>

        <p>
            <span class="label">Nouvelles dates proposées :</span><br>
            Du {{ Carbon::parse($petSittingRequest->requested_start_date)->format('d/m/Y') }}
            au {{ Carbon::parse($petSittingRequest->requested_end_date)->format('d/m/Y') }}
        </p>

        <p>
            <span class="label">Message du petsitter :</span>
        </p>

        <p>
            {{ $petSittingRequest->requested_description }}
        </p>

    </div>

    <p style="text-align: center; margin-top: 30px;">
        <a href="{{ route('owner.history') }}" class="button">
            Consulter la demande
        </a>
    </p>

@endsection
