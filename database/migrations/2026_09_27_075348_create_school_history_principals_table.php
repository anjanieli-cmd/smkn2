<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_history_principals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_history_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('period_label')->nullable(); // "2014 – 2018"
            $table->string('photo')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('is_current')->default(false);

            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_history_principals');
    }
};
