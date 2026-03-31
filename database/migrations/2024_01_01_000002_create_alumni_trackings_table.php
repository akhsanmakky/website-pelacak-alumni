<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni_trackings', function (Blueprint $table) {
            $table->id();
$table->foreignId('alumni_id')->constrained('alumni')->onDelete('cascade');
            $table->string('status_karir_old');
            $table->string('status_karir_new');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_trackings');
    }
};

