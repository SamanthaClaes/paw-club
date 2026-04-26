<?php

use Livewire\Component;

new class extends Component {
    public string $title = 'Paw Club';

};
?>

<div>
    <section class="mt-20">
        <div class="flex flex-row-reverse gap-8">
            <img src="{{ asset('img/hero_image.jpeg') }}" alt="personne assise qui jouent avec des chiens de petites tailles"
                     class="w-full  object-cover rounded-lg">
            <div class="border-5 border-element rounded-lg">
                <h1 class=" ">{{ $title }}</h1>
                <span class="">
                    La garderie qui fait sentir vos compagnons comme à la maison, même en votre absence
                </span>
                <div>
                    <a href="#">Réserver une garde</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2>Comment se passent les séjours ? </h2>
    </section>
</div>
