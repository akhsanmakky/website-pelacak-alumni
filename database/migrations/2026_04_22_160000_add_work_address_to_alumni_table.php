<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni', 'alamat_bekerja')) {
                $table->text('alamat_bekerja')->nullable()->after('perusahaan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            if (Schema::hasColumn('alumni', 'alamat_bekerja')) {
                $table->dropColumn('alamat_bekerja');
            }
        });
    }
};

