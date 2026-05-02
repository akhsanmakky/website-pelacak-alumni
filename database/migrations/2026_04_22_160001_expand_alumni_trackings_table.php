<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni_trackings', 'perusahaan_old')) {
                $table->string('perusahaan_old')->nullable()->after('status_karir_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'perusahaan_new')) {
                $table->string('perusahaan_new')->nullable()->after('perusahaan_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'pekerjaan_old')) {
                $table->string('pekerjaan_old')->nullable()->after('perusahaan_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'pekerjaan_new')) {
                $table->string('pekerjaan_new')->nullable()->after('pekerjaan_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'alamat_bekerja_old')) {
                $table->text('alamat_bekerja_old')->nullable()->after('pekerjaan_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'alamat_bekerja_new')) {
                $table->text('alamat_bekerja_new')->nullable()->after('alamat_bekerja_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'company_social_old')) {
                $table->string('company_social_old')->nullable()->after('alamat_bekerja_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'company_social_new')) {
                $table->string('company_social_new')->nullable()->after('company_social_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'linkedin_old')) {
                $table->string('linkedin_old')->nullable()->after('company_social_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'linkedin_new')) {
                $table->string('linkedin_new')->nullable()->after('linkedin_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'instagram_old')) {
                $table->string('instagram_old')->nullable()->after('linkedin_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'instagram_new')) {
                $table->string('instagram_new')->nullable()->after('instagram_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'facebook_old')) {
                $table->string('facebook_old')->nullable()->after('instagram_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'facebook_new')) {
                $table->string('facebook_new')->nullable()->after('facebook_old');
            }
            if (!Schema::hasColumn('alumni_trackings', 'tiktok_old')) {
                $table->string('tiktok_old')->nullable()->after('facebook_new');
            }
            if (!Schema::hasColumn('alumni_trackings', 'tiktok_new')) {
                $table->string('tiktok_new')->nullable()->after('tiktok_old');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni_trackings', function (Blueprint $table) {
            $table->dropColumn([
                'perusahaan_old', 'perusahaan_new',
                'pekerjaan_old', 'pekerjaan_new',
                'alamat_bekerja_old', 'alamat_bekerja_new',
                'company_social_old', 'company_social_new',
                'linkedin_old', 'linkedin_new',
                'instagram_old', 'instagram_new',
                'facebook_old', 'facebook_new',
                'tiktok_old', 'tiktok_new',
            ]);
        });
    }
};

