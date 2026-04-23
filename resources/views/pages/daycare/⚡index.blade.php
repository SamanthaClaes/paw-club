<?php

use Livewire\Component;

new class extends Component {
    public string $title = 'Paw Club';

};
?>

<div>
    <section>
        <div>
            <div>
                <h1>{{ $title }}</h1>
                <span>La garderie qui fait sentir vos compagnons comme à la maison, même en votre absence</span>
                <div c>
                    <a  href="#">Réserver une garde</a>
                </div>
            </div>
            <img src="{{ asset('img/hero_image.jpeg') }}"  alt="test">
        </div>
    </section>
    <section>
        <h2>Comment se passent les séjours ? </h2>
    </section>
</div>
