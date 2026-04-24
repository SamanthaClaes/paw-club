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
    <section class="relative w-full h-[40vh] overflow-hidden">
        <img src="{{ asset('img/Hero_home.jpeg') }}" alt="pleins de chiens en balade"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center gap-4">
            <h1 class="
               text-white text-6xl font-bold uppercase z-10">Paw club</h1>
            <span class=" text-white text-3xl z-10">Un service de garde fiable et attentionné pour accompagner votre animal en toute sérénité.</span>
        </div>
    </section>
    <section class="px-6 py-12">
        <div class="mx-auto mr-25 ml-25 px-6 border-5 border-element rounded-lg p-8">
            <div class="flex justify-center">
                <h2 class="text-text text-3xl uppercase font-bold mb-6">A propos de nous</h2>
            </div>
            <div class="p-8 flex gap-8">
                <img src="{{ asset('img/picture_card.jpg')}}"
                     alt="chien blanc avec une femme qui lui tient les oreilles" class="h-111.25 rounded-lg">
                <p class="text-lg/10 text-text">PawClub est un espace de garderie dédié exclusivement aux chiens,
                    offrant un environnement sécurisé, encadré et adapté à leurs besoins. Chaque animal y est accueilli
                    avec attention, dans un cadre pensé pour favoriser son bien-être, sa socialisation et son
                    épanouissement tout au long de la journée. En parallèle, la plateforme propose un service de mise en
                    relation permettant de réserver une garde auprès de l’un de nos petsitters. Chaque petsitter définit
                    ses disponibilités et les types d’animaux qu’il accepte, afin de garantir une prise en charge
                    adaptée et personnalisée. PawClub permet également à toute personne souhaitant s’investir dans la
                    garde d’animaux de devenir petsitter, en rejoignant une communauté encadrée et orientée vers le
                    bien-être animal.</p>
                <div class="absolute">
                    <img src="{{ asset('svg/illu_1.svg') }}"
                         alt="illustration d'un homme et d'une femme jouant au frisbee avec un chien." height="557"
                         width="557" class="relative top-40 left-280">
                </div>
            </div>
            <div class="flex justify-center bg-card-green hover:bg-hover p-5 w-1/2 mx-auto rounded-lg mb-6">
                <a href="#" class="text-text text-2xl font-bold uppercase">Découvrir nos petsitters</a>
            </div>
        </div>
    </section>
    <section>
        <h2 class="text-center font-extrabold text-text text-5xl mb-6">Nos services</h2>
        <div class="flex gap-8">
            <div class="border-5 border-card-orange rounded-lg ml-25 ">
                <h3 class="mt-8 mb-8 text-center text-4xl text-text font-bold">Notre garderie</h3>
                <div class="p-8 mb-">
                    <p class="text-lg leading-10 text-text mb-20 px-10">Dans notre garderie, vos chiens sont accueillis
                        dans un espace
                        sécurisé et encadré, où ils profitent d’attention, de jeux et de moments de socialisation tout
                        au long de la journée, en présence d’une équipe attentive à leur bien-être. Chaque accueil est
                        pensé pour répondre à leurs besoins, en tenant compte de leur rythme, de leur caractère et de
                        leurs habitudes. Notre objectif est de leur offrir un environnement rassurant et stimulant, afin
                        qu’ils puissent s’épanouir pleinement pendant votre absence.</p>
                </div>
                <div
                    class="flex  bg-card-orange p-5 w-1/2 mx-auto rounded-lg mb-20 hover:bg-hover-orange cursor-pointer">
                    <a href="" class="text-text text-2xl font-bold uppercase  hover:text-white">Réserver une garde</a>
                </div>
                <div class="absolute">
                    <img src="{{ asset('svg/icons 1.svg') }}" alt="" class="relative bottom-45 left-135">
                </div>
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
