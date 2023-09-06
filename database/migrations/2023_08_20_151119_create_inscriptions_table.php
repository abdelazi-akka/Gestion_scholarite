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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id("id_affectation");
            $table->unsignedBigInteger('id_module');
            $table->unsignedBigInteger('id_groupe');
            $table->unsignedBigInteger('id_prof');
            $table->foreign('id_prof')->references('id')->on('users')->onDelete('cascade')->onUpdate("cascade");
            $table->foreign('id_module')->references('id_module')->on('modules')->onDelete('cascade');
            $table->foreign('id_groupe')->references('id_groupe')->on('groupes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_module');
    }
};
