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
        Schema::create('livre_imprimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loge_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('division_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('cote');
            $table->string('auteur');
            $table->string('titre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre_imprimes');
    }
};
