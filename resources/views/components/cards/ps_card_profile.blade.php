@props([
 'name',
 'email',
 'phone',
 'adress',
])

<section>
    <h1>Informations personnelles</h1>
    <div>
    <div>
        <img src="" alt="Image de profile">
    </div>
    <div>
        <p>Nom & Prénom : {{ $name }}</p>
    </div>
    <div>
        <p>Email :  {{ $email }}</p>
    </div>
    <div>
        <p>Téléphone : {{ $phone}}</p>

    </div>
    <div>
        <p>Adresse postale : {{ $adress }}</p>
    </div>
        
</section>
