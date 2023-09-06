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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id("id_groupe");
            $table->string("nom_groupe");
            $table->string("code_groupe")->unique();
            $table->string("cin");
            $table->string("code_filliere");
            $table->foreign("code_filliere")->references("code_filliere")->on("fillieres")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("cin")->references("cin")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupes');
    }
};
