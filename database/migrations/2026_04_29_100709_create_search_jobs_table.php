<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('search_jobs', function (Blueprint $table) {
            $table->id();
$table->foreignId('alumni_profile_id')->references('id')->on('alumni_profiles')->cascadeOnDelete();
            $table->string('query');
            $table->enum('source', ['google', 'scholar', 'github', 'univ_dir', 'company_dir', 'orcid'])->index();
            $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');
            $table->json('results')->nullable(); // array of result summaries
            $table->timestamps();
            
            $table->index(['alumni_profile_id', 'source']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_jobs');
    }
};

