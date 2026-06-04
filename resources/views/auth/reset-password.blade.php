@extends('layouts.login')

@section('content')
    <section>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase text-center m-10"> Réinitialiser votre mot de passe</h1>
        <form action="{{ route('password.update') }}"  method="POST" class="w-8/10 mx-auto bg-white p-10 rounded-lg">
            @csrf
            <input class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full" type="hidden" name="token"
                   value="{{ $request->route('token') }}">
            <div>
            <label for="email">Email</label>
            <input class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full" type="email" name="email"
                   placeholder="Email">
            </div>
            <div>
                <label for="password">Choisissez votre mot de passe</label>
            <input class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full" type="password"
                   name="password" placeholder="Nouveau mot de passe">
            </div>
            <div>
                <label for="password_confirmation">Confirmer le mot de passe</label>
            <input class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full" type="password"
                   name="password_confirmation" placeholder="Confirmer le mot de passe">
            </div>
            <div class="flex justify-center">
            <button type="submit"
                    class="bg-element p-4 rounded-lg w-1/2 font-bold uppercase hover:bg-hover-element cursor-pointer">
                Réinitialiser le mot de passe
            </button>
            </div>
        </form>
    </section>
@endsection
