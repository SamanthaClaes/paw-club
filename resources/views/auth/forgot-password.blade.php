@extends('layouts.login')
@section('content')
    <section>
        <div class="flex justify-center">
            <x-svg.logo class="w-50 h-50 mb-8"/>
        </div>
        <h1 class="text-3xl font-bold text-text mb-8 uppercase text-center m-10">{{ __('auth.forgot') }} </h1>
        <form action="{{ route('password.email') }}" method="POST" class="w-8/10 mx-auto bg-white p-10 rounded-lg">
            @csrf
            <div>
                <label for="email">{{ __('auth.email') }}</label>
                <input type="email" name="email"
                       class="border-2 border-element bg-white rounded-lg px-3 py-2 mb-6 w-full">
            </div>
            <div class="flex justify-center">
                <button type="submit"
                        class="bg-element p-4 rounded-lg w-1/2 font-bold uppercase hover:bg-hover-element cursor-pointer">
                    {{ __('auth.reset') }}
                </button>
            </div>
        </form>
    </section>
@endsection
