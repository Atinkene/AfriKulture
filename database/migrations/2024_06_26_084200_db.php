<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('niveaus', function (Blueprint $table) {
            $table->id();
            $table->enum('nom', ['DEBUTANT', 'INTERMEDIAIRE', 'EXPERT'])->unique();
            $table->unsignedBigInteger('force')->unique();
            $table->string('icone')->unique();
            $table->timestamps();
        });

        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->dateTime('dateDebut');
            $table->time('HeureDebut');
            $table->string('duree');
            $table->boolean('visibilite');
            $table->boolean('joueurAnonyme');
            $table->string('description');
            $table->string('miniature');
            $table->string('imageFond');
            $table->string('couleurFond');
            $table->foreignId('niveau')->constrained('niveaus')->onDelete('restrict')->onUpdate('restrict')->nullable();
            $table->foreignId('admin')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('distinctions', function (Blueprint $table) {
            $table->id();
            $table->enum('nom', ['DEBUTANT', 'INTERMEDIAIRE', 'EXPERT'])->unique();
            $table->string('badge')->unique();
            $table->timestamps();
        });

        Schema::create('distinctionjoueurs', function (Blueprint $table) {
            $table->id();
    
            $table->foreignId('distinction')->constrained('distinctions')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('joueur')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
                  

            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
                  
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('nombrePoint');
            $table->foreignId('partie')->constrained('parties')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('propositions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->boolean('estCorrecte');   
            $table->foreignId('question')->constrained('questions')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('choix', function (Blueprint $table) {
            $table->id();
            $table->foreignId('joueur')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('proposition')->constrained('propositions')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->float('score');
            $table->string('icone');
            $table->unsignedBigInteger('rang');
            $table->foreignId('joueur')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('partie')->constrained('parties')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaus');
        Schema::dropIfExists('parties');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('distinctions');
        Schema::dropIfExists('distinctionjoueurs');
        Schema::dropIfExists('propositions');
        Schema::dropIfExists('resultats');
        Schema::dropIfExists('choix');
    }
};
