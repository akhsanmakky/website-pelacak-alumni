<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->string('phone')->nullable();

            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();

            $table->string('company_social')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'linkedin',
                'instagram',
                'facebook',
                'tiktok',
                'company_social'
            ]);
        });
    }
};