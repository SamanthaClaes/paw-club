<?php

use Livewire\Attributes\Title;
use Livewire\Component;


new class extends Component { //on peut mettre #[Title('title')] entre le new et le class pour que ça fonctionne aussi

    public function render()
    {
        return $this->view()->title('Paw Club Accueil');
    }

};
?>

<div>
    <section class="h-[20vh] relative w-full md:h-[40vh] overflow-hidden">
        <img src="{{ asset('img/Hero_home.jpeg') }}" alt="pleins de chiens en balade"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4">
            <h1 class="
               text-white text-2xl md:text-6xl font-bold uppercase z-10">Paw club</h1>
            <span class=" text-sm text-center text-white md:text-3xl z-10">Un service de garde fiable et attentionné pour accompagner votre animal en toute sérénité.</span>
        </div>
    </section>
    <section class="px-6 py-12">
        <div class="relative mx-auto max-w-6xl border-5 border-element rounded-lg px-4 sm:px-6 lg:px-8 py-8">

            <div class="flex justify-center">
                <h2 class="text-text text-2xl sm:text-3xl uppercase font-bold mb-6 text-center">
                    A propos de nous
                </h2>
            </div>

            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-10">

                <img
                    src="{{ asset('img/picture_card.jpg')}}"
                    alt="chien blanc avec une femme"
                    class="w-full max-w-sm sm:max-w-md lg:max-w-87.5 h-auto rounded-lg object-cover"
                >

                <p class=" line-clamp-5 md:text-text text-sm  max-w-2xl mb-5 text-center lg:line-clamp-none lg:text-left">
                    PawClub est un espace de garderie dédié exclusivement aux chiens,
                    offrant un environnement sécurisé, encadré et adapté à leurs besoins.
                    Chaque animal y est accueilli avec attention, dans un cadre pensé pour
                    favoriser son bien-être, sa socialisation et son épanouissement tout au
                    long de la journée.
                    En parallèle, la plateforme propose un service de
                    mise en relation permettant de réserver une garde auprès de l'un de nos
                    petsitters.
                    Chaque petsitter définit ses disponibilités et les types
                    d'animaux qu'il accepte, afin de garantir une prise en charge adaptée
                    et personnalisée. PawClub permet également à toute personne souhaitant
                    s'investir dans la garde d'animaux de devenir petsitter, en rejoignant
                    une communauté encadrée et orientée vers le bien-être animal.
                </p>
                <img
                    src="{{ asset('svg/illu_1.svg') }}"
                    alt="une femme et un homme jouant au frisbee avec un chien"
                    class="
            pointer-events-none
            absolute
            bottom-0 right-0
            w-30 sm:w-40 md:w-56 lg:w-64 xl:w-72
            translate-x-1/4 translate-y-1/4">
            </div>
            <div class="flex justify-center">
                <a href="#" class=" text-cta  font-bold uppercase bg-card-green hover:bg-hover hover:text-white p-5 lg:w-1/2 rounded-lg mb-6  text-center">Découvrir nos petsitters</a>
            </div>

        </div>
    </section>
    <section>
        <h2 class="text-center text-2xl font-extrabold text-text lg:text-5xl lg:mb-6">Nos services</h2>
        <div class="px-6 py-6 lg:flex gap-8">
            <div class="border-5 mx-auto max-w-6xl border-card-orange rounded-lg sm:px-6 lg:px-8 py-8">
                <h3 class="mt-4 mb-4 lg:mt-8 lg:mb-8 text-center lg:text-4xl text-text font-bold">Notre garderie</h3>
                <div>
                    <p class="text-lg leading-8 line-clamp-7 text-text px-10 md:text-text  mb-5 text-center lg:text-left lg:line-clamp-none">
                        Dans notre garderie, vos chiens sont accueillis
                        dans un espace
                        sécurisé et encadré, où ils profitent d’attention, de jeux et de moments de socialisation tout
                        au long de la journée, en présence d’une équipe attentive à leur bien-être. Chaque accueil est
                        pensé pour répondre à leurs besoins, en tenant compte de leur rythme, de leur caractère et de
                        leurs habitudes. Notre objectif est de leur offrir un environnement rassurant et stimulant, afin
                        qu’ils puissent s’épanouir pleinement pendant votre absence.</p>
                </div>
                <div class="flex">
                    <a href=""
                       class="text-text text-2xl font-bold uppercase bg-card-orange p-5 w-1/2 mx-auto rounded-lg mb-20 hover:bg-hover-orange hover:text-white cursor-pointer">Réserver
                        une garde</a>
                </div>
             {{--   <div class="absolute">
                    <img src="{{ asset('svg/icons 1.svg') }}" alt="" class="relative bottom-45 left-135">
                </div>--}}
            </div>
            <div>
                <h3>Nos petsitters</h3>
                <div>
                    <p>Nos petsitters s’occupent de vos animaux en fonction de leurs besoins spécifiques et des
                        informations renseignées dans leur fiche, afin d’assurer une prise en charge adaptée et
                        personnalisée.
                        Chaque petsitter définit en amont les types d’animaux qu’il peut accueillir ainsi que ses
                        disponibilités, garantissant ainsi une correspondance cohérente avec votre demande. Grâce à
                        cette organisation, vos compagnons bénéficient d’une attention particulière et d’un
                        environnement adapté, en toute confiance.</p>
                </div>
                <div>
                    <a href="">Réserver un petsitter</a>
                </div>
            </div>
        </div>
    </section>
</div>
