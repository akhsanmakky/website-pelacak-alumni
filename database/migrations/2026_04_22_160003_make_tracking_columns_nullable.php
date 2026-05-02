<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            $table->string('status_karir_old')->nullable()->change();
            $table->string('status_karir_new')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            $table->string('status_karir_old')->nullable(false)->change();
            $table->string('status_karir_new')->nullable(false)->change();
        });
    }
};
