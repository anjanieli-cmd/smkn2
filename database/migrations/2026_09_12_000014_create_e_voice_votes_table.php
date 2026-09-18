<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_voice_votes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('e_voice_id');
            $table->string('voter_ip_hash');
            $table->timestamps();

            $table->foreign('e_voice_id')->references('id')->on('e_voices')->onDelete('cascade');
            $table->unique(['e_voice_id', 'voter_ip_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_voice_votes');
    }
};
