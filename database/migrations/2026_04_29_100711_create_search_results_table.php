<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('search_results', function (Blueprint $table) {
            $table->id();
$table->foreignId('search_job_id')->references('id')->on('search_jobs')->cascadeOnDelete();
            $table->string('title');
            $table->string('url');
            $table->text('snippet')->nullable();
            $table->date('publish_date')->nullable();
            $table->json('signals')->nullable(); // {"name_match": 0.9, "affiliation": ["UMM"], "job": "Engineer", "location": "Malang", "year_activity": 2023}
            $table->float('score', 3, 2)->default(0.0);
            $table->boolean('is_match')->default(false);
            $table->timestamps();
            
            $table->index('search_job_id');
            $table->index('score');
            $table->index('is_match');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_results');
    }
};

