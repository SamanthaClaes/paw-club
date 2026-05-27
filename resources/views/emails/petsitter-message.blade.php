@extends('layouts.mail')

@section('content')

    <section>
        <h1>
            Nouveau message reçu
        </h1>

        <p>
            Vous avez reçu un nouveau message depuis le formulaire de contact PawClub.
        </p>

        <div class="card">

            <p>
                <span class="label">Nom :</span>
                {{ $data['first_name'] }}
                {{ $data['last_name'] }}
            </p>

            <p>
                <span class="label">Email :</span>
                {{ $data['email'] }}
            </p>

            <p>
                <span class="label">Téléphone :</span>
                {{ $data['phone'] }}
            </p>

            <p>
                <span class="label">Message :</span>
            </p>

            <p>
                {{ $data['message'] }}
            </p>

        </div>
        ```

    </section>

@endsection
