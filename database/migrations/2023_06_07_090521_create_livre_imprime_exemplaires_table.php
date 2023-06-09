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
        Schema::create('livre_imprime_exemplaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livre_imprime_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('statut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre_imprime_exemplaires');
    }
};
