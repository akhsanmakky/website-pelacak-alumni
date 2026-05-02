<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_profiles', function (Blueprint $table) {
            $table->id();
$table->foreignId('alumni_id')->references('id')->on('alumni')->cascadeOnDelete();
            $table->json('name_variations');
            $table->json('keywords'); // {"affiliation": ["UMM", "Universitas Muhammadiyah Malang"], "prodi": [...], "year": 2020, "city": "Malang"}
            $table->enum('status', ['pending', 'processing', 'identified', 'needs_manual', 'not_found'])->default('pending');
            $table->float('confidence', 3, 2)->default(0.0); // 0.00-1.00
            $table->timestamp('last_tracked_at')->nullable();
            $table->timestamps();
            
            $table->unique('alumni_id');
            $table->index(['status', 'confidence']);
            $table->index('last_tracked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_profiles');
    }
};

