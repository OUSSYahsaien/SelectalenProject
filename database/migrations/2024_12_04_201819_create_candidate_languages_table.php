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
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_candidat');
            $table->string('language');
            // $table->enum('proficiency', ['Beginner', 'Intermediate', 'Advanced', 'Fluent', 'Native'])->default('Beginner'); // Niveau de maîtrise
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_languages');
    }
};
