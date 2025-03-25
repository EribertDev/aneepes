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
       // Création de la table des commentaires
       Schema::create('comments', function (Blueprint $table) {
        $table->id();
        // Clé étrangère vers les posts, suppression en cascade en cas de suppression du post
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        // Clé étrangère vers les utilisateurs, suppression en cascade en cas de suppression de l'utilisateur
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content');
        $table->timestamps();
    });


    // Création de la table des évaluations (ratings)
    Schema::create('ratings', function (Blueprint $table) {
        $table->id();
        // Clé étrangère vers les posts
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
// Hash anonymisé (IP + user_agent)
        $table->string('identifier'); 

        // Valeur de l'évaluation (par exemple, de 1 à 5)
        $table->unsignedTinyInteger('value');
        $table->timestamps();
    });

 

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // On supprime d'abord la table ratings (qui dépend de posts et users)
        Schema::dropIfExists('ratings');
        // Puis la table comments
        Schema::dropIfExists('comments');
    }
};
