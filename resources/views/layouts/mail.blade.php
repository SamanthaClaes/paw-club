<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PawClub' }}</title>

    <style>

        body {
            margin: 0;
            padding: 40px 20px;
            background-color: #FFFFFF;
            font-family: Quicksand, ui-sans-serif, system-ui, sans-serif;
            color: #000633;
        }

        .wrapper {
            width: 100%;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border: 1px solid #88C4C9;
            border-radius: 32px;
            overflow: hidden;
        }

        .header {
            background-color: #C0E2E5;
            padding: 45px 40px;
            text-align: center;
        }

        .subtitle {
            margin-top: 12px;
            margin-bottom: 0;
            color: #000633;
            font-size: 15px;
        }

        .content {
            padding: 50px 45px;
        }

        .footer {
            background-color: #C0E2E5;
            border-top: 1px solid #88C4C9;
            padding: 30px;
            text-align: center;
        }

        .footer-text {
            margin: 0;
            color: #000633;
            font-size: 14px;
            line-height: 24px;
        }

        .footer-copy {
            margin-top: 10px;
            margin-bottom: 0;
            color: #000633;
            font-size: 12px;
        }

        .card {
            margin-top: 30px;
            padding: 25px;
            background-color: #F5FFFF;
            border: 1px solid #88C4C9;
            border-radius: 24px;
        }

        .label {
            font-weight: 700;
            color: #000633;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 36px;
            line-height: 46px;
            color: #000633;
        }

        p {
            font-size: 16px;
            line-height: 28px;
        }

        .logo-image {
            width: 180px;
            max-width: 100%;
            height: auto;
        }

    </style>

</head>

<body>

<div class="wrapper">

    <div class="container">

        <div class="header">

            <img
                src="{{ asset('img/logo.webp') }}"
                alt="Logo PawClub"
                class="logo-image"
            >

            <p class="subtitle">
                Votre plateforme de petsitting de confiance
            </p>

        </div>

        <div class="content">

            @yield('content')

        </div>

        <div class="footer">

            <p class="footer-text">
                Merci de faire confiance à PawClub 🐾
            </p>

            <p class="footer-copy">
                © {{ now()->year }} PawClub — Tous droits réservés
            </p>

        </div>

    </div>

</div>

</body>

</html>
