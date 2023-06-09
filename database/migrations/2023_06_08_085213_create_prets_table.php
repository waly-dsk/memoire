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
        Schema::create('prets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('abonne_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('livre_imprime_exemplaire_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin_prevue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prets');
    }
};
