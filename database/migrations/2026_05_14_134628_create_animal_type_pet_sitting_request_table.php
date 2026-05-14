<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animal_type_pet_sitting_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_type_id');
            $table->foreignId('pet_sitting_request_id');



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_type_pet_sitting_request');
    }
};
