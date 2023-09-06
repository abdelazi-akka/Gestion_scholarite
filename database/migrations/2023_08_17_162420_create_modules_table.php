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
        Schema::create('modules', function (Blueprint $table) {
            $table->id("id_module");
            $table->string("intitule_module");
            $table->string("code_module")->unique();
            $table->string("semestre_module");
            $table->unsignedBigInteger("id");
            $table->string("code_filliere");
            $table->string("cin");
            $table->foreign("cin")->references("cin")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("code_filliere")->references("code_filliere")->on("fillieres")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
