<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extracurricular_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('question_id');
            $table->text('option_text');
            $table->json('extracurricular_scores'); // Score mapping e.g. {"PRAMUKA": 10, "PASKIBRA": 5}
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('extracurricular_questions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extracurricular_options');
    }
};
