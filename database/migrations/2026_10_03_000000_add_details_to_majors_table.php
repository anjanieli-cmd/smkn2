<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('majors', 'details')) {
            Schema::table('majors', function (Blueprint $table) {
                $table->longText('details')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('majors', 'details')) {
            Schema::table('majors', function (Blueprint $table) {
                $table->dropColumn('details');
            });
        }
    }
};
