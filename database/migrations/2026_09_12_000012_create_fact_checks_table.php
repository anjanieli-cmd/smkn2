<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fact_checks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('claim');
            $table->text('verdict_explanation');
            $table->string('status')->default('UNCONFIRMED'); // VERIFIED, FALSE, UNCONFIRMED
            $table->string('source_url')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fact_checks');
    }
};
