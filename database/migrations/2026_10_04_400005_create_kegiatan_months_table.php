<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kegiatan_months')) {
            return;
        }

        Schema::create('kegiatan_months', function (Blueprint $table) {
            $table->id();
            $table->string('label', 20);                           // JAN, FEB, ...
            $table->string('event');
            $table->string('note')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_months');
    }
};
