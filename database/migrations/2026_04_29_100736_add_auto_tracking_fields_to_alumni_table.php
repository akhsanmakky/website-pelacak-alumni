<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->enum('auto_tracking_status', ['none', 'pending', 'processing', 'identified', 'needs_manual', 'not_found'])->default('none')->after('pddikti_status');
            $table->float('auto_confidence', 3, 2)->nullable()->after('auto_tracking_status');
            $table->timestamp('last_auto_tracked_at')->nullable()->after('auto_confidence');
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn(['auto_tracking_status', 'auto_confidence', 'last_auto_tracked_at']);
        });
    }
};

