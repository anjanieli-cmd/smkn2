<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_history_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_history_id')->constrained()->cascadeOnDelete();

            $table->string('image');
            $table->string('small_label')->nullable(); // "Program keahlian"
            $table->string('big_label')->nullable();    // "APHP · Agribisnis..."
            $table->boolean('is_featured')->default(false); // jadi mosaic-card.big

            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_history_galleries');
    }
};
