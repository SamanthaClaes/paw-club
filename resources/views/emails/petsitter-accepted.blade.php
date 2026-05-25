<section>
    <h1> Bonjour {{ $petsitter->first_name }}</h1>

    <p>
        Votre demande à bien été acceptée
    </p>
    <div>
        <h2>Vos identifiants</h2>

        <p>
            email : {{ $petsitter->email }}
        </p>
        <p>
            Mot de passe : password
        </p>
        Nous vous conseillons de changer rapidement votre mot de passe dans vos paramètres.
    </div>

</section>
