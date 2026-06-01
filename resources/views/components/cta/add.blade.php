<button @click="$dispatch('open-pets-modal')" {{ $attributes->merge(['class'=>'p-3  lg:p-2 font-medium rounded-lg  lg:text-lg cursor-pointer']) }}
>
    {{ $title }}
</button>
