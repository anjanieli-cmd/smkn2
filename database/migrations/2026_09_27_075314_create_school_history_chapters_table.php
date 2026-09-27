<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_history_chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_history_id')->constrained()->cascadeOnDelete();

            $table->string('kicker')->nullable();     // "BAB PERTAMA"
            $table->string('year_label')->nullable();  // "24 JUNI 2013"
            $table->string('icon')->nullable();         // "fa-flag"
            $table->string('tag')->nullable();           // "Fondasi"

            $table->string('short_title')->nullable();   // sisi kiri buku
            $table->text('short_desc')->nullable();

            $table->string('long_title')->nullable();    // sisi kanan / halaman detail
            $table->string('lead')->nullable();
            $table->text('body')->nullable();
            $table->text('note')->nullable();

            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_history_chapters');
    }
};
