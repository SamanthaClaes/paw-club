@extends('layouts.login')
@section('content')
    <section>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase text-center m-10">Vous avez oublié votre mot de
            passe? </h1>
        <form action="{{ route('password.email') }}" method="POST" class="w-8/10 mx-auto bg-white p-10 rounded-lg">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email"
                       class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full">
            </div>
            <div class="flex justify-center">
                <button type="submit"
                        class="bg-element p-4 rounded-lg w-1/2 font-bold uppercase hover:bg-hover-element cursor-pointer">
                    Réinitiliser mon mot de passe
                </button>
            </div>
        </form>
        <div
            x-data="{ show: false }"
            x-init="
        setTimeout(() => show = true, 100);
        setTimeout(() => show = false, 4000);
    "
            x-show="show"
            x-cloak
            x-transition:enter="transform transition duration-700 ease-out"
            x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform transition duration-500 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
            class="bg-green-100 border border-green-400 text-green-800 text-center font-bold px-4 py-3 rounded-lg mb-6 w-full mx-auto">
            @if( session('status'))
                <p>
                    {{ session('status') }}
                </p>

            @endif
        </div>
    </section>
@endsection
