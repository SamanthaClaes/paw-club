<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pet_sitting_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_type_id')->constrained()->cascadeOnDelete();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('animal_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('breed');
            $table->string('animal_age');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_sitting_requests');
    }
};
