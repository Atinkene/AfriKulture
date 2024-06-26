<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('duree');
            $table->boolean('visibilite');
            $table->enum('niveau', ['FACILE', 'INTERMEDIAIRE', 'EXPERT'])->nullable();
            $table->dateTime('dateDebut')->unique();
            $table->time('HeureDebut')->unique();
            $table->foreignId('admin')->constrained('users')->onDelete('restrict')->onUpdate('restrict');
            $table->timestamps();
        });

        Schema::create('partiejoueurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partie');
            $table->unsignedBigInteger('joueur');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('partie')
                  ->references('id')->on('parties')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('joueur')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
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

        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->float('score');
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
        Schema::dropIfExists('parties');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('partiejoueurs');
        Schema::dropIfExists('propositions');
        Schema::dropIfExists('scores');
        Schema::dropIfExists('choix');
    }
};
