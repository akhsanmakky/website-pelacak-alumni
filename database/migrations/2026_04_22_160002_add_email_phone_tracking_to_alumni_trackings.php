<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni_trackings', 'email_old')) {
                $table->string('email_old')->nullable()->after('tiktok_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'email_new')) {
                $table->string('email_new')->nullable()->after('email_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'no_hp_old')) {
                $table->string('no_hp_old')->nullable()->after('email_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'no_hp_new')) {
                $table->string('no_hp_new')->nullable()->after('no_hp_old');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            $table->dropColumn(['email_old', 'email_new', 'no_hp_old', 'no_hp_new']);
        });
    }
};

