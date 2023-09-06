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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id("id_etudiant");
            $table->string("nom");
            $table->string("prenom");
            $table->string("adresse");
            $table->string("cin");
            $table->string("telephonne");
            $table->string("cne");
            $table->string("num_appoge");
            $table->unique(["cin","cne","num_appoge"]);
            $table->string("code_groupe");
            $table->foreign("code_groupe")->references("code_groupe")->on("groupes")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};