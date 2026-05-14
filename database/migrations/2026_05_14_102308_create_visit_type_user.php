<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visit_type_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('visit_type_id');



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_type_user');
    }
};
