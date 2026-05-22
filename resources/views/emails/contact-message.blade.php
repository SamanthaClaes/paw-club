<h1 class="text-text">
    Nouveau message de la part de
    {{ $data['first_name'] }}
    {{ $data['last_name'] }}
</h1>

<p class="font-bold">
    Email : {{ $data['email'] }}
</p>

<p class="font-bold text-text">
    Message :
</p>

<p>
    {{ $data['message'] }}
</p>
