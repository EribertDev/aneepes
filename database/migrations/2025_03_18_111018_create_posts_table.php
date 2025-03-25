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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('image')->nullable();
            $table->foreignId('editor_id')->constrained('users');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->enum('category', ['sante', 'academique', 'emploi', 'culture','logement','evenements','technology','autre'])->default('autre');
            $table->json('tags')->nullable();
            $table->dateTime('publication_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
