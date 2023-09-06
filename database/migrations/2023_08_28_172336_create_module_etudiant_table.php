<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('module_etudiant', function (Blueprint $table) {
            $table->id("id_note");

            // Foreign key for module
            $table->unsignedBigInteger("id_module");
            $table->foreign("id_module")->references("id_module")->on('modules')->onDelete("cascade")->onUpdate("cascade");

            // Foreign key for etudiant
            $table->unsignedBigInteger("id_etudiant");
            $table->foreign("id_etudiant")->references("id_etudiant")->on('etudiants')->onDelete("cascade")->onUpdate("cascade");

            $table->decimal("note");
            $table->integer("etat")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_etudiant');
    }
};
