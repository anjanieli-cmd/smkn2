<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bkk_industries')) {
            return;
        }

        Schema::create('bkk_industries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('field_of_work')->nullable();      // mis. "IT & Telekomunikasi"
            $table->string('partnership_scope')->nullable();  // mis. "PKL, Kelas Industri & Rekrutmen Lulusan"
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bkk_industries');
    }
};
