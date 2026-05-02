<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {

            if (!Schema::hasColumn('alumni', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('alumni', 'linkedin')) {
                $table->string('linkedin')->nullable();
            }

            if (!Schema::hasColumn('alumni', 'instagram')) {
                $table->string('instagram')->nullable();
            }

            if (!Schema::hasColumn('alumni', 'facebook')) {
                $table->string('facebook')->nullable();
            }

            if (!Schema::hasColumn('alumni', 'tiktok')) {
                $table->string('tiktok')->nullable();
            }

            if (!Schema::hasColumn('alumni', 'company_social')) {
                $table->string('company_social')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // optional (boleh dikosongkan biar aman)
        });
    }
};