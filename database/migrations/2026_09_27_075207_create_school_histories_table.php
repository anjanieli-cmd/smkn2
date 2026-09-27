<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_histories', function (Blueprint $table) {
            $table->id();

            // Hero
            $table->string('hero_kicker')->nullable();
            $table->string('hero_image')->nullable(); // ornamen background hero

            // Intro / Statistik
            $table->string('intro_eyebrow')->nullable();
            $table->string('intro_title')->nullable();
            $table->text('intro_desc')->nullable();

            $table->string('stat1_value')->nullable();
            $table->string('stat1_label')->nullable();
            $table->string('stat2_value')->nullable();
            $table->string('stat2_label')->nullable();
            $table->string('stat3_value')->nullable();
            $table->string('stat3_label')->nullable();
            $table->string('stat4_value')->nullable();
            $table->string('stat4_label')->nullable();

            // Story band ("Manusianya. Semangatnya.")
            $table->string('story_eyebrow')->nullable();
            $table->string('story_title')->nullable();
            $table->text('story_desc')->nullable();
            $table->string('story_image')->nullable();
            $table->json('story_chips')->nullable(); // ["Berkarakter","Kompeten",...]

            // Virtual Tour
            $table->string('vt_title')->nullable();
            $table->text('vt_desc')->nullable();
            $table->string('vt_link')->nullable();
            $table->string('vt_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_histories');
    }
};
