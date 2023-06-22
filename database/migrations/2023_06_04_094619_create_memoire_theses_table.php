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
        Schema::create('memoire_theses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_document_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('cote')->unique();
            $table->string('theme');
            $table->string('auteur');
            $table->string('encadreur');
            $table->foreignId('option_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('annee');
            $table->binary('pdf')->nullable();
            $table->integer('exemplaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memoire_theses');
    }
};
